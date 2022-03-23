import createPersistedState from 'vuex-persistedstate'

export default ({ store }) => {
    window.onNuxtReady((nuxt) => {
        createPersistedState({
            key: 'pasttime',
            storage: window.sessionStorage
        })(store);
    });
}