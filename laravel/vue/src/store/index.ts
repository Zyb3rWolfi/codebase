import axios from 'axios';
import { Commit, createStore, Store } from 'vuex'

export default createStore({

    state: {
        auth: false,
    },
    mutations: {
        SET_AUTH: (state: {auth: boolean}, authh: boolean) => state.auth = authh,
    },
    actions: {
        setAuthentication: ({commit}: {commit: Commit}, authh: boolean) => commit('SET_AUTH', authh) 
    },
    modules: {

    },
});