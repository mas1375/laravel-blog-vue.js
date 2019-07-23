<template>
    <div>
        <form @submit.prevent="addPost()" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control mb-2" placeholder="Title" v-model="post.title">
                <textarea cols="30" rows="10" class="form-control mb-2" placeholder="body" v-model="post.body"></textarea>
                <input type="submit" value="Save" class="btn btn-light btn-block">
            </div>
        </form>
        <div class="card mb-2" v-for="post in posts" v-bind:key="post.id">
            <div class="card-body">
            <h3>{{ post.title }}</h3>
            <small>By {{ post.author }}</small>
            <hr>
            <button  @click="deletePost(post.id)" class="btn border border-danger float-left">Delete</button>
            <button  @click="editPost(post)" class="btn border border-success float-right">Edit</button>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"  v-bind:class="[{ disabled: !pagination.prev_page_url }]"><a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item text-dark disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li class="page-item"  v-bind:class="[{ disabled: !pagination.next_page_url }]"><a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    data(){
        return{
            posts: [],
            post: {
                id: '',
                title: '',
                body: '',
                cover_image: '',
            },
            post_id:'',
            pagination: [] ,
            edit: false,
        }
    },

    created() {
        this.fetchPosts();
    },

    methods: {
        fetchPosts(page_url){
            let vm = this;
            page_url = page_url || '/api/posts';
           fetch(page_url)
           .then(res=> res.json())
           .then(res=> {
               this.posts = res.data;
               vm.makePagination(res.meta , res.links);
           })
           .catch(err => console.log(err));

        },
        makePagination(meta , links) {
            let pagination  = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };

            this.pagination = pagination;
        },
        deletePost(id) {
            if(confirm('Are you sure ?')){
                fetch(`api/post/${id}`, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    this.fetchPosts();
                })
                .catch(err => console.log(err))
            }
        },

        addPost() {
            if(this.edit === false){
                // add
                fetch('api/post' , {
                    method: 'post',
                    body: JSON.stringify(this.post),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.post.title = '',
                    this.post.body =  '',
                    this.fetchPosts();
                })
                .catch(err => console.log(err))
            }else{
                 fetch('api/post' , {
                    method: 'put',
                    body: JSON.stringify(this.post),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.post.title = '',
                    this.post.body =  '',
                    this.fetchPosts();
                })
                .catch(err => console.log(err))
            }

        },
        editPost(post){
            this.edit = true;
            this.post.id = post.id;
            this.post.post_id = post.id;
            this.post.title = post.title;
            this.post.body = post.body;
        }

    }
}
</script>

