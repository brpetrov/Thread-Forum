<script>
import Favorite from '../components/Favorite'
export default {
    props:['attributes'],
    components:{Favorite},
data(){
    return{
        editing:false,
        body:this.attributes.body
    }
},
methods:{
    update(){
        axios.patch('/replies/' + this.attributes.id,{
            body:this.body
        })
        this.editing=false;

        flash('Reply updated');
    },

    deleteReply(){
        axios.delete('/replies/' + this.attributes.id);
        $(this.$el).fadeOut(300, ()=>{
            flash('Reply deleted');
        });
    }
}
}
</script>

