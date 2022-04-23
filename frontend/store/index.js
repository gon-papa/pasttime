export const state = () => ({
    user: null,
});

export const mutations = {
    setUser(state, user) {
        state.user = user;
    },
};

export const actions = {
    async login({ commit }, credentials) {
        try {
            await this.$axios.$get('/csrf-cookie');
            let response = await this.$axios.$post('/login', credentials);
            let data = await this.$axios.$get('/user');

            await commit('setUser', data.user);
            return response;
        } catch(err) {
            console.log(err.response);
            return err.response.data;
        }
    },
    async logout({ commit }) {
        let response = await this.$axios.$get('/logout');
        try {
            commit('setUser', null);
        } catch(err) {
            console.log(err.response.data);
            return err.response.data;
        }
        return response;
    },
    nuxtClientInit({ commit }) {
        const data = JSON.parse(sessionStorage.getItem('pasttime')) || [];
        // if(data) {
            commit('setUser', data.user);
        // }
    },
};