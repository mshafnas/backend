<template>
    <alert v-model="showRight" placement="top-right" duration="3000" type="success" width="400px" dismissable>
    <span class="icon-ok-circled alert-icon-float-left"></span>
    <strong>Order Alert!</strong>
    <p>You got an update for pizza order (Order ID : {{order_id}})</p>
</alert>
</template>

<script>
    import {alert} from 'vue-strap'
    export default {
        components: {
            alert
        },
        props: ['user_id'],

        data () {
            return {
                showRight: false,
                order_id: ''
            }
        },

        mounted() {
            window.Echo.channel('pizza-tracker')
            .listen('OrderStatusChanged', (order) => {
                if (this.user_id == order.user_id) {
                    this.order_id = order.id,
                    this.showRight = true 
                }   
            })
        }
    }
</script>
