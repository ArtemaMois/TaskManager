<template>
  <div class="main-class">
    <nav-bar v-if="$route.path !== '/'"></nav-bar>
    <div class="main-menu">
      <my-main-foot>
        <template v-slot:name>Админ</template>
        <template v-slot:title>Управление</template>
      </my-main-foot>
      <div class="search-section">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Поиск пользователя..."
          class="search-input"
        />
        <button class="save-button" @click="saveChanges" :disabled="!hasChanges">
        Сохранить изменения
      </button>
      </div>
      
      <my-error v-if="showSuccessMessage">Изменения успешно сохранены</my-error>
      <div class="users-list">
        <div v-if="loading" class="loading">Загрузка...</div>
        <div v-else-if="error" class="error">{{ error }}</div>
        <div v-else-if="filteredUsers.length === 0" class="no-results">
          Пользователи не найдены
        </div>
        <div v-else class="user-item" v-for="(user, index) in filteredUsers" :key="user.id">
          <div class="user-number">{{ index + 1 }}</div>
          <img
            :src="user.image || './assets/default-images/user-img/user.png'"
            alt="User avatar"
            class="user-image"
          />
          <div class="user-name">{{ user.login }}</div>
          <select
            v-model="user.role_code"
            class="role-select"
            @change="confirmRoleChange(user)"
          >
            <option v-for="role in roles" :key="role.code" :value="role.code">
              {{ role.name }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div class="modal" v-if="showModal">
      <div class="modal-content">
        <p>Вы уверены, что хотите изменить роль для {{ pendingUser?.login }}?</p>
        <div class="modal-buttons">
          <button class="modal-button confirm" @click="applyRoleChange">Да</button>
          <button class="modal-button cancel" @click="cancelRoleChange">Нет</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
import axios from 'axios';

export default {
  name: 'AdminPage',
  setup() {
    const users = ref([]);
    const roles = ref([]);
    const searchQuery = ref('');
    const loading = ref(true);
    const error = ref(null);
    const showModal = ref(false);
    const pendingUser = ref(null);
    const originalRoles = ref({});
    const changedUsers = ref({});
    const showSuccessMessage = ref(false);

    const fetchUsers = async () => {
      loading.value = true;
      error.value = null;
      try {
        const token = localStorage.getItem('api_token');
        if (!token) {
          throw new Error('Токен не найден. Пожалуйста, войдите в систему.');
        }

        const response = await axios.get('http://localhost:80/api/accounts/admin/users', {
          headers: { Authorization: token },
        });

        console.log('Список:', response);

        if (response.data.status === 'success') {
          users.value = response.data.users
            .filter((user) => user && user.role && user.role.code)
            .map((user) => ({
              id: user.id,
              login: user.login,
              image: user.image,
              role_code: user.role.code,
            }));
          roles.value = response.data.roles.filter((role) => role && role.code && role.name);
          users.value.forEach((user) => {
            originalRoles.value[user.id] = user.role_code;
          });
        } else {
          throw new Error('Не удалось загрузить данные');
        }
      } catch (e) {
        error.value = e.message || 'Произошла ошибка при загрузке данных';
      } finally {
        loading.value = false;
      }
    };

    const filteredUsers = computed(() => {
      if (!searchQuery.value) return users.value;
      return users.value.filter((user) =>
        user.login.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });

    const hasChanges = computed(() => Object.keys(changedUsers.value).length > 0);

    const confirmRoleChange = (user) => {
      if (user.role_code !== originalRoles.value[user.id]) {
        pendingUser.value = { ...user };
        showModal.value = true;
      }
    };

    const cancelRoleChange = () => {
      if (pendingUser.value) {
        pendingUser.value.role_code = originalRoles.value[pendingUser.value.id];
        delete changedUsers.value[pendingUser.value.id];
      }
      showModal.value = false;
      pendingUser.value = null;
    };

    const applyRoleChange = async () => {
      if (!pendingUser.value) return;

      try {
        const token = localStorage.getItem('api_token');
        const response = await axios.patch(
          'http://localhost:80/api/accounts/admin/users',
          {
            user_id: pendingUser.value.id,
            role: pendingUser.value.role_code,
          },
          { headers: { Authorization: token } }
        );

        if (response.data.status === 'success') {
          changedUsers.value[pendingUser.value.id] = pendingUser.value.role_code;
          originalRoles.value[pendingUser.value.id] = pendingUser.value.role_code;
          const user = users.value.find((u) => u.id === pendingUser.value.id);
          if (user) {
            user.role_code = pendingUser.value.role_code;
          }
        } else {
          throw new Error('Не удалось изменить роль');
        }
      } catch (e) {
        error.value = e.message || 'Ошибка при изменении роли';
        pendingUser.value.role_code = originalRoles.value[pendingUser.value.id];
      } finally {
        showModal.value = false;
        pendingUser.value = null;
      }
    };

    const saveChanges = async () => {
      if (!hasChanges.value) return;

      try {
        const token = localStorage.getItem('api_token');
        const changes = Object.entries(changedUsers.value).map(([userId, roleCode]) => ({
          user_id: parseInt(userId),
          role: roleCode,
        }));

        for (const change of changes) {
          await axios.patch(
            'http://localhost:80/api/accounts/admin/users',
            change,
            { headers: { Authorization: token } }
          );
        }

        showSuccessMessage.value = true;
        setTimeout(() => {
          showSuccessMessage.value = false;
        }, 5000);

        await fetchUsers();
        changedUsers.value = {};
      } catch (e) {
        error.value = e.message || 'Ошибка при сохранении изменений';
      }
    };

    const filterUsers = () => {
      searchQuery.value = searchQuery.value.trim();
    };

    fetchUsers();

    return {
      users,
      roles,
      searchQuery,
      filteredUsers,
      loading,
      error,
      showModal,
      pendingUser,
      confirmRoleChange,
      cancelRoleChange,
      applyRoleChange,
      saveChanges,
      filterUsers,
      hasChanges,
      showSuccessMessage,
    };
  },
};
</script>

<style lang="scss" scoped>
.main-class {
  display: grid;
  grid-template-columns: 17.5% 82.5%;
  padding: 32px;
}

.main-menu {
  width: 100%;
  max-width: 100%;
  padding-left: 32px;
  background-color: #fafafa;
}

.search-section {
  display: flex;
  max-width: 700px;
  gap: 16px;
  margin-top: 50px;
  padding-right: 16px;
}

.search-input {
  flex-grow: 1;
  padding: 12px;
  font-family: NimbusRegular;
  font-size: 14px;
  border: 1px solid #d2d2d2;
  border-radius: 8px;
  outline: none;
}

.save-button {
  padding: 12px 24px;
  background: #546fff;
  color: #fff;
  font-family: NimbusRegular;
  font-size: 14px;
  border: none;
  border-radius: 8px;
  cursor: pointer;

  &:disabled {
    background: #546fff;
    cursor: not-allowed;
  }
}

.users-list {
  margin-top: 24px;
  padding-right: 32px;
}

.user-item {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 12px;
  background: #fff;
  border-radius: 8px;
  margin-bottom: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.user-number {
  width: 36px;
  text-align: center;
  font-family: NimbusRegular;
  font-size: 14px;
  color: #141522;
}

.user-name {
  flex-grow: 1;
  font-family: NimbusRegular;
  font-size: 14px;
  color: #141522;
}

.user-image {
  max-width: 40px;
}

.role-select {
  padding: 8px;
  font-family: NimbusRegular;
  font-size: 14px;
  border: 1px solid #d2d2d2;
  border-radius: 8px;
  background: #fff;
  cursor: pointer;
}

.loading,
.error,
.no-results {
  text-align: center;
  font-family: NimbusRegular;
  font-size: 14px;
  padding: 20px;
}

.error {
  color: #ff4d4f;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 2000;
}

.modal-content {
  background: #fff;
  padding: 24px;
  border-radius: 12px;
  text-align: center;
  font-family: NimbusRegular;
  font-size: 14px;
  max-width: 400px;
  width: 90%;
}

.modal-buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  margin-top: 16px;
}

.modal-button {
  padding: 10px 20px;
  font-family: NimbusRegular;
  font-size: 14px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}

.modal-button.confirm {
  background: #546fff;
  color: #fff;
}

.modal-button.cancel {
  background: #f5f5f7;
  color: #141522;
}

@media (max-width: 1024px) {
  .main-class {
    grid-template-columns: 5% 1fr;
    padding: 16px;
  }
  .main-menu {
    padding-left: 16px;
    margin-left: 16px;
  }
}

@media (max-width: 767px) {
  .main-class {
    grid-template-columns: 5% 1fr;
  }

  .search-section {
    flex-direction: column;
    gap: 12px;
    margin-top: 24px;
  }

  .search-input,
  .save-button {
    width: 100%;
  }

  .user-item {
    align-items: center;
    padding: 16px;
  }

  .user-number {
    width: auto;
  }

  .role-select {
    width: 100%;
  }
}

@media (max-width: 480px) {
  .main-class {
    padding: 16px;
  }

  .search-input,
  .search-button,
  .save-button {
    font-size: 13px;
    padding: 10px;
  }

  .user-item {
    padding: 12px;
  }

  .user-number,
  .user-name,
  .role-select {
    font-size: 13px;
  }
}
</style>
