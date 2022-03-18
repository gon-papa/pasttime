export const state = () => ({
    user: '',
    isAuth: false,
});

export const mutations = {
    set_auth (state, auth) {
        state.isAuth = auth;
    },

    set_user (state, user) {
        state.user = user;
    },
};

export const actions = {
    async login({ commit }, credentials) {
        try {
            await this.$axios.$get('/csrf-cookie');
            let response = await this.$axios.$post('/login', credentials);
            let data = await this.$axios.$get('/user');

            commit('set_auth', true);
            commit('set_user', data.user);
            return response;
        } catch(err) {
            console.log(err.response.data);
            return err.response.data;
        }
    },
    async logout({ commit }) {
        let response = await this.$axios.$get('/logout');
        try {
            commit('set_auth', false);
            commit('set_user', null);
        } catch(err) {
            console.log(err.response.data);
            return err.response.data;
        }
        return response;
    }
};