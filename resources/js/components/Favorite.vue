<template>
    <button @click="toggle" :class="classes">
        <i v-text="count" class="far fa-thumbs-up"></i>
    </button>
</template>

<script>
export default {
    props:['reply'],
    data(){
        return{
            count:this.reply.favoritesCount,
            active: this.reply.isFavorited
        }
    },

    computed:{
        classes(){
            return['btn',  'mx-1', this.active ?  'btn-primary text-white' : 'btn-outline-primary text-dark' ]
        }
    },

    methods:{
        toggle(){
            return this.active ? this.destroy() : this.create()
        },

        create(){
            axios.post('/replies/' + this.reply.id + '/favorites')
            this.active=true,
            this.count++
        },
        destroy(){
            axios.delete('/replies/' + this.reply.id + '/favorites')
            this.active=false,
            this.count--
        }
    }
}
</script>

<style>

</style>
