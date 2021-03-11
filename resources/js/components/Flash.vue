<template>
    <div class="fixed-bottom alert alert-success mb-0 text-center" role="alert" v-show="show">
        {{body}}
    </div>
</template>

<script>
    export default {
        props:['message'],
        data(){
            return{
            body:this.message,
            show:false

            }
        },

        created(){
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash',message => {
                this.flash(message);
            });
        },
        methods:{
            flash(message){
                this.body=message;
                this.show=true;

                this.hide();
            },

            hide(){
                 setTimeout(()=>{
                    this.show=false;
                },3000)
            }
        }
    }
</script>

<style>
[v-cloak]{display: none;}
</style>
