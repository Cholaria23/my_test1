<template>

    <div id="toast-container" class="toast-bottom-full-width" v-if="message.type && message.text">

        <div :class="'toast toast-' + message.type">
            <div class="toast-message">
                {{ message.text }}
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props: ['message']
    }
</script>