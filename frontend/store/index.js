export const state = () => ({
    userId: '',
    userName: '',
});

export const mutations = {
    initUser (state, user) {
        state.userId = user.id;
        state.userName = user.name;
    },

    removeUser (state) {
        state.userId = '';
        state.userName = '';
    },
};

export const actions = {
    addUser ({ commit }, user) {
        commit('initUser', user);
    },

    removeUser ({ commit }) {
        commit('removeUser');
    }
};