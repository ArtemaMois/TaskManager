```vue
<template>
  <div class="main-class">
    <nav-bar v-if="$route.path !== '/'"></nav-bar>
    <div class="main-menu">
      <my-main-foot>
        <template v-slot:name>Никита</template>
        <template v-slot:title>Давайте закончим это задание сегодня!</template>
      </my-main-foot>
      <div class="activity-menu">
        <my-runing></my-runing>
        <my-activity></my-activity>
      </div>
      <div class="slider-box">
        <my-slider></my-slider>
      </div>
      <div class="slider-box-small" style="padding-bottom: 32px;">
        <my-sslider></my-sslider>
      </div>
    </div>
    <div class="finished-menu">
      <my-taskcard></my-taskcard>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      posts: [],
      dialogVisible: false,
      isPostsLoading: false,
      selectedSort: '',
      searchQuery: '',
      pageNum: 1,
      limitPage: 10,
      totalPage: 0,
      sortOptions: [
        { value: 'title', name: 'По названию' },
        { value: 'body', name: 'По описанию' },
      ],
    };
  },
  methods: {
    createPost(post) {
      this.posts.push(post);
      this.dialogVisible = false;
    },
    removePost(post) {
      this.posts = this.posts.filter((p) => p.id !== post.id);
    },
    showDialog() {
      this.dialogVisible = true;
    },
    async fetchPosts() {
      try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts', {
          params: {
            _page: this.pageNum,
            _limit: this.limitPage,
          },
        });
        this.totalPage = Math.ceil(response.headers['x-total-count'] / this.limitPage);
        this.posts = response.data;
        this.isPostsLoading = true;
      } catch (e) {
        alert('Ошибка!');
      }
    },
    async loadMorePosts() {
      try {
        this.pageNum += 1;
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts', {
          params: {
            _page: this.pageNum,
            _limit: this.limitPage,
          },
        });
        this.totalPage = Math.ceil(response.headers['x-total-count'] / this.limitPage);
        this.posts = [...this.posts, ...response.data];
        this.isPostsLoading = true;
      } catch (e) {
        alert('Ошибка!');
      }
    },
  },
  computed: {
    sortedPosts() {
      return [...this.posts].sort((post1, post2) =>
        post1[this.selectedSort]?.localeCompare(post2[this.selectedSort])
      );
    },
    sortedSearchPosrs() {
      return this.sortedPosts.filter((post) =>
        post.title.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.main-class {
  display: flex;
  gap: 16px;
  padding: 16px;
}

@media (min-width: 768px) {
  .main-class {
    display: grid;
    grid-template-columns: 17.5% 1fr 30.6%;
    padding: 32px;
  }
}

.main-menu {
  max-width: 752px;
  padding-left: 32px;
  background-color: #fafafa;
}

.finished-menu {
  max-width: 436px;
  grid-column: 3;
  background: #f5f5f7;
}

@media (max-width: 1024px) {
    .main-class {
        display: grid;
        grid-template-columns: 5% 1fr 30.6%;
        padding: 16px;
    }
}

@media (max-width: 767px) {
  .main-class {
    display: flex;
    padding: 16px;
  }

  .main-menu {
    padding-left: 0;
    max-width: 100%;
  }

  .finished-menu {
    max-width: 100%;
    margin-top: 16px;
    order: 0; /* Перемещает finished-menu перед main-menu */
  }
}

@media (max-width: 480px) {
  .main-class {
    padding: 12px;
  }

  .main-menu {
    padding-left: 0;
  }

  .finished-menu {
    margin-top: 12px;
  }
}

.activity-menu {
  display: flex;
  flex-direction: row;
  gap: 32px;
  margin-top: 44px;
}

.slider-box-small {
  display: flex;
  flex-direction: column;
  gap: 32px;
}
</style>
```