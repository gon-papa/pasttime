export const state = () => ({
    isProcessing: false,
});

export const getters = {
    getIsProcessing: state => state.isProcessing,
};

export const mutations = {
    setProcess(state, isProcessing) {
        state.isProcessing = isProcessing;
    },
};

export const actions = {
    isProcessing({ commit }) {
        commit('setProcess', true);
        console.log('fafafa');
        setTimeout(() => {
            commit('setProcess', false);
        }, 1000);
    }
};