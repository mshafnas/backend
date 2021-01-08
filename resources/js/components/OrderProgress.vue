<template>
    <div>
        <div class="progress">
            <progressbar :now="progress" type="primary" striped animated></progressbar>
        </div>
        <div class="mt-2"><p><b>Order Status</b> {{statusNew}}</p></div>
        <img src="/img/delivery.gif" class="w-100" alt="delivery image" v-if="progress >= 100">
    </div>
</template>

<script>
    import {progressbar} from 'vue-strap'
    export default {
        components: {
            progressbar
        },
        props: ['status', 'initial', 'order_id'],

        data () {
            return {
                statusNew: this.status,
                progress: this.initial
            }
        },

        mounted() {
            window.Echo.channel('pizza-tracker.' + this.order_id)
            .listen('OrderStatusChanged', (order) => {
                this.statusNew = order.status_name,
                this.progress = order.status_percent
            })
        }
    }
</script>
