<template>
  <my-input
    v-model="searchQuery"
    placeholder="Поиск"
    style="margin-bottom: 10px"
  />
  

  <my-dialog v-model:show="dialogVisible">
    <signForm @create="createPost"> </signForm>
  </my-dialog>

  <postList
    :posts="sortedSearchPosrs"
    @remove="removePost"
    v-if="isPostsLoading"
  ></postList>

</template>

<script>
import axios from 'axios'
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
    }
  },
  methods: {
    createPost(post) {
      this.posts.push(post)
      this.dialogVisible = false
    },
    removePost(post) {
      this.posts = this.posts.filter((p) => p.id !== post.id)
    },
    showDialog() {
      this.dialogVisible = true
    },
    /* changePage(page) {
            this.pageNum = page;
        }, */
    async fetchPosts() {
      try {
        const response = await axios.get(
          'https://jsonplaceholder.typicode.com/posts',
          {
            params: {
              _page: this.pageNum,
              _limit: this.limitPage,
            },
          }
        )
        this.totalPage = Math.ceil(
          response.headers['x-total-count'] / this.limitPage
        )
        this.posts = response.data
        this.isPostsLoading = true
      } catch (e) {
        alert('Ошибка!')
      }
    },
    async loadMorePosts() {
      try {
        this.pageNum += 1
        const response = await axios.get(
          'https://jsonplaceholder.typicode.com/posts',
          {
            params: {
              _page: this.pageNum,
              _limit: this.limitPage,
            },
          }
        )
        this.totalPage = Math.ceil(
          response.headers['x-total-count'] / this.limitPage
        )
        this.posts = [...this.posts, ...response.data]
        this.isPostsLoading = true
      } catch (e) {
        alert('Ошибка!')
      }
    },
  },
  // mounted() {
  //     this.fetchPosts();
  //     const options = {
  //     rootMargin: "0px",
  //     threshold: 1.0,
  //     };
  //     const callback = () => {
  //         if (this.pageNum < this.totalPage) {
  //             this.loadMorePosts()
  //             console.log(this.pageNum)

  //         }

  //     };
  //     const observer = new IntersectionObserver(callback, options);
  //     observer.observe(this.$refs.observer);
  // },
 
  watch: {
    /* pageNum() {
            this.fetchPosts();
        } */
  },
}
</script>

<style>
.main-class {
  display: grid;
  grid-template-columns: 17.5% 1fr 30.6%;
}
.main-menu {
  grid-column: 2;
  max-width: 752px;
  padding-left: 32px;
  background-color: #fafafa;
}
.app__btns {
  display: flex;
  justify-content: space-between;
}
.page__wrapper {
  display: flex;
  margin-top: 15px;
}
.page {
  border: 2px solid black;
  padding: 10px;
}

.finished-menu {
  max-width: 436px;
  grid-column: 3;
  background: #f5f5f7;
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
