<template>
    <div class="main-class">
        <nav-bar v-if="$route.path !== '/'" ></nav-bar>
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
            
            <!-- <my-input
                v-model="searchQuery"
                placeholder="Поиск"
                style="margin-bottom: 10px;"
            />
            <div class="app__btns">
                <my-button
                @click="showDialog"
                style="margin-top: 15px; margin-bottom: 15px; padding: 7px;"
                >
                Создать пост
                </my-button>
                <my-select
                    v-model="selectedSort"
                    :options="sortOptions"
                />
            </div>   
            
            <my-dialog v-model:show="dialogVisible">
                <signForm
                    @create="createPost"
                    >   
                </signForm>
            </my-dialog>
            
            <postList 
                :posts="sortedSearchPosrs"
                @remove="removePost"
                v-if="isPostsLoading"
            ></postList>
            
            <div v-else>Загрузка...</div>
            <div ref="observer" class="observer">
            
            </div>
             <div class="page__wrapper">
                <div 
                    v-for="page in totalPage" 
                    :key="page"
                    class="page"
                    :class="{
                        'current-page': pageNum === page
                    }"
                    @click="changePage(page)"
                >
                    {{ page }}
                </div>
            </div> -->
        </div>
        <div class="finished-menu">
            <my-taskcard></my-taskcard>
        </div>
    </div>
</template>

<script>
// import signForm from '@/components/signForm.vue';
// import postList from '@/components/postList.vue';
// import myDialog from '@/components/UI/myDialog.vue';
// import myButton from '@/components/UI/myButton.vue';
// import mySelect from '@/components/UI/mySelect.vue';
import axios from 'axios';
// import myInput from '@/components/UI/myInput.vue';
export default {
    components: {
        // signForm, postList, myDialog, myButton, mySelect, myInput
    },
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
                {value: 'title', name: 'По названию'},
                {value: 'body', name: 'По описанию'},
            ]
        }
    },
    methods: {
        createPost(post) {
            this.posts.push(post);
            this.dialogVisible = false;
        },
        removePost(post) {
            this.posts = this.posts.filter(p => p.id !== post.id)
        },
        showDialog() {
            this.dialogVisible = true;
        },
        /* changePage(page) {
            this.pageNum = page;
        }, */
        async fetchPosts() {
            try {
                const response = await axios.get('https://jsonplaceholder.typicode.com/posts', {
                    params: {
                        _page: this.pageNum,
                        _limit: this.limitPage,
                    }
                });
                this.totalPage = Math.ceil(response.headers['x-total-count'] / this.limitPage)
                this.posts = response.data;
                this.isPostsLoading = true;


            } catch (e) {
                alert('Ошибка!')
            } 
        },
        async loadMorePosts() {
            try {
                this.pageNum += 1;
                const response = await axios.get('https://jsonplaceholder.typicode.com/posts', {
                    params: {
                        _page: this.pageNum,
                        _limit: this.limitPage,
                    }
                });
                this.totalPage = Math.ceil(response.headers['x-total-count'] / this.limitPage)
                this.posts = [...this.posts, ...response.data];
                this.isPostsLoading = true;


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
    computed: {
        sortedPosts() {
            return [...this.posts].sort((post1, post2) => post1[this.selectedSort]?.localeCompare(post2[this.selectedSort]))
        },
        sortedSearchPosrs() {
            return this.sortedPosts.filter(post => post.title.toLowerCase().includes(this.searchQuery.toLowerCase()))
        }
    },
    watch: {
        /* pageNum() {
            this.fetchPosts();
        } */
    }
}
</script>

<style>

.main-class{
    display: grid;
    grid-template-columns: 17.5% 1fr 30.6%;
}
.main-menu{
    grid-column: 2;
    max-width: 752px;
    padding-left: 32px;
    background-color: #FAFAFA;
}
.app__btns{
    display: flex;
    justify-content: space-between;
}
.page__wrapper{
    display: flex;
    margin-top: 15px;

}
.page{
    border: 2px solid black;
    padding: 10px;
}


.finished-menu{
    max-width: 436px;
    grid-column: 3;
    background: #F5F5F7;
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