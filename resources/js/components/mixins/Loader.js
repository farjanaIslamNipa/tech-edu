
const Loader = {
    methods: {
        loader(isActive, loader) {
            return isActive ? this.$loading.show({color: 'red'}) : loader.hide()
        },
    }
};

export default Loader;
