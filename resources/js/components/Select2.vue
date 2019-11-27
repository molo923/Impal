<template>
    <select class="form-control" :class="this.className" :placeholder="this.placeholder">
        <slot></slot>
    </select>
</template>

<script>
    export default {
        props: ['options', 'value', 'placeholder', 'className'],
        name: "Select2",
        mounted() {
            let vm = this;
            let el = $(this.$el);
            $(this.$el)
                .select2({
                    data: this.options,
                    width: '100%',
                    placeholder: el.attr('placeholder'),
                })
                .val(this.value)
                .trigger('change')
                .on('change', function() {
                    vm.$emit('input', this.value)
                });
        },
        watch: {
            value(value) {
                $(this.$el)
                    .val(value)
                    .trigger('change');
            },
            options(options) {
                let el = $(this.$el);
                $(this.$el).empty().select2({
                    data: options,
                    width: '100%',
                    placeholder: el.attr('placeholder'),
                })
            }
        }
    }
</script>
