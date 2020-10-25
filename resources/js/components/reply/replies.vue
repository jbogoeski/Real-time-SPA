<template>
    
    <div v-if="question.replies">
        <reply 
        v-for="(reply,index) in content" 
        :key="reply.id"
        :index='index'        
        :data="reply"></reply>
    </div>

</template>

<script>
import Reply from './reply'
export default {
    props:['question'],
    data() {
        return {
            content: this.question.replies,
        }
    },
    components:{Reply},
    created() {
        this.listen()
    },
    methods: {
        listen() {
            EventBus.$on('newReply',(reply) => {
                this.content.unshift(reply)
            })
            EventBus.$on('deleteReply',(index) => {
                axios.delete(`/api/question/${this.question.slug}/reply/${this.content[index].id}`)
                .then(res => {
                    this.content.splice(index,1)
                })
            })
            Echo.private('App.Models.User.' + User.id())
            .notification((notification) => {
                this.content.unshift(notification.reply)
            });

            Echo.channel('deleteReply')
            .listen('DeleteReplyEvent',(e) => {
                for(let index = 0; index < this.content.length; index++){
                    if(this.content[index].id == e.id) {
                        this.content.splice(index,1)
                    }
                }
            })
        }
    }
}
</script>