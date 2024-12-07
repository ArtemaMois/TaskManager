<template>
    <div 
      ref="dropZone"
      class="drop-zone"
      @dragover.prevent="onDragOver"
      @dragleave="onDragLeave"
      @drop.prevent="onDrop"
    >
      <p v-if="!image">Перетащите фото сюда</p>
      <img v-if="image" :src="image" alt="Фото профиля" class="profile-photo" />
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    name: 'my-dragdrop',
    data() {
      return {
        image: null,
        serverResponse: null,
      };
    },
    methods: {
      onDragOver() {
        this.$refs.dropZone?.classList.add('drag-over');
      },
      onDragLeave() {
        this.$refs.dropZone?.classList.remove('drag-over');
      },
      async onDrop(event) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        if (files.length === 0) return;
        const file = files[0];
        const formData = new FormData();
        formData.append("file", file);

        try {
          const response = await axios.patch("http://127.0.0.1:88/api/accounts/me", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          });
          console.log("Файл загружен!", response.data);
          
        } catch (e) {
          console.log("Ошибка при загрузке!", e);
        }





        // const file = event.dataTransfer.files[0];
  
        // if (file && file.type.startsWith('image/')) {

        //   const reader = new FileReader();
        //   reader.onload = () => {
        //     this.image = reader.result;
        //   };
        //   reader.readAsDataURL(file);
  
        //   try {
        //     const response = await this.createFile();
        //     this.serverResponse = response;
        //     console.log('Успешно загружено:', response);
        //     console.log('Успешно загружено:', file);
        //   } catch (error) {
        //     console.error('Ошибка загрузки:', error);
        //   }
        // }
        // this.$refs.dropZone?.classList.remove('drag-over');
      },

      // async createFile() {
      //   axios.patch('http://127.0.0.1:88/api/accounts/me', this.file, {
      //       _method: 'PATCH',
      //       photo: this.file, 
      //   }, {
      //           'Content-Type': 'multipart/form-data',
      //           'cookie': localStorage.getItem('xsrfToken'), 
      //       })
      //           .then(response => console.log(response))
      //           .catch(error => console.log(error))
      //       },
      //           onAttachmentChange (e) {
      //           this.file.image = e.target.files[0]
      //       }
        }
    };
  </script>
  
  <style scoped>
  .drop-zone {
    margin: 32px 0 0 32px;
    width: 200px;
    height: 250px;
    border: 1px dashed #546FFF;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #aaa;
    background-color: #f9f9f9;
    transition: background-color 0.3s;
  }
  
  .drop-zone:hover,
  .drop-zone.drag-over {
    opacity: 30%;
    border-color: #333;
    transition: 0.3s;
  }
  
  .profile-photo {
    max-width: 100%;
    max-height: 100%;
  }
  .drop-zone img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
  }
  </style>