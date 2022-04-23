export default ({ store }, inject) => {
    const app = {
        isProcessing: () => {
            return store.getters['process/getIsProcessing'];
        },
    }
    inject('app', app)
}