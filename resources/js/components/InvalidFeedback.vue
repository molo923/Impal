<template>
    <span class="invalid-feedback" role="alert">
        <strong>{{ this.message }}</strong>
    </span>
</template>

<script>
    export default {
        props: ['message'],
        name: "InvalidFeedback"
    }
</script>
