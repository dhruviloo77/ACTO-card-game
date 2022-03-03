<template>

</template>

<script>



export default {
    name: 'card-component',
    data() {
        return {
            success: false,
            error: false,

            formData: {
                name: null,
                card: null
            }
        }
    },
    methods: {

        displayResult() {
            axios.post('/result',this.formData)
                .then((res) => {
                    this.onSuccess(res.data.data)
                })
                .catch((error) => {
                    this.onFailure(error.response.message)
                })
        },

        onSuccess(message){
            this.success = true;
            this.error = false;
        },

        onFailure(message){
            this.error = true;
            this.success = false;
        }
    }
}
</script>
