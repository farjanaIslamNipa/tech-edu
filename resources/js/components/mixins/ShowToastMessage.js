const ShowToastMessage = {
    methods: {
        showToastMessage(toastObject) {
            if (typeof toastObject === 'object' && toastObject.message) {
                this.$toast.open({
                    message: toastObject.message,
                    type: toastObject.type ?? 'default',
                    position: 'bottom-right',
                    duration: 8000,
                    dismissible: true,
                });
            }
        },
    }
};

export default ShowToastMessage;