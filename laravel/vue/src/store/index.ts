import axios from 'axios';
import { Commit, createStore, Store } from 'vuex'

export default createStore({

    state: {
        auth: false,
        id: -1,
        blockRefresh: false,
        
    },
    mutations: {
        SET_AUTH: (state: {auth: boolean}, authh: boolean) => state.auth = authh,
        SET_ID: (state: {id: number}, id: number) => state.id = id,
        SET_BLOCK_REFRESH: (state: {blockRefresh: boolean}, block: boolean) => state.blockRefresh = block,

    },
    actions: {
        setAuthentication: ({commit}: {commit: Commit}, authh: boolean) => commit('SET_AUTH', authh),
        setUserID: ({commit}: {commit: Commit}, id: number) => commit('SET_ID', id),
        setBlockRefresh: ({commit}: {commit: Commit}, block: boolean) => commit('SET_BLOCK_REFRESH', block),
    },
    modules: {

    },
});