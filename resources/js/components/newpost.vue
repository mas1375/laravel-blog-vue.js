<template>
    <div>
        <form @submit.prevent="AddPost()" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control mb-2" placeholder="Title" v-model="post.title">
                <textarea cols="30" rows="10" class="form-control mb-2" placeholder="body" v-model="post.body"></textarea>
                <input type="submit" value="Save" class="btn btn-light btn-block">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'newpost'
}
</script>
