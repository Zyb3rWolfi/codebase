import axios from 'axios';
import { Commit, createStore, Store } from 'vuex'

export default createStore({

    state: {
        auth: false,
        id: -1,
        blockRefresh: false,
        toasts : [],
        SignupModalState : 1,
        filterLanguages: [],
        
    },
    mutations: {
        SET_AUTH: (state: {auth: boolean}, authh: boolean) => state.auth = authh,
        SET_ID: (state: {id: number}, id: number) => state.id = id,
        SET_BLOCK_REFRESH: (state: {blockRefresh: boolean}, block: boolean) => state.blockRefresh = block,
        ADD_TOAST: (state: {toasts: any}, toast: any) => state.toasts.push(toast),
        REMOVE_TOAST: (state: {toasts: any}, toast: any) => state.toasts.splice(state.toasts.indexOf(toast), 1),
        SET_SIGNUP_MODAL_STATE: (state: {SignupModalState: number}, statee: number) => state.SignupModalState = statee,
        SET_FILTER_LANGUAGES: (state: {filterLanguages: any}, languages: any) => state.filterLanguages = languages,
    },
    actions: {
        setAuthentication: ({commit}: {commit: Commit}, authh: boolean) => commit('SET_AUTH', authh),
        setSignupModalState: ({commit}: {commit: Commit}, state: number) => commit('SET_SIGNUP_MODAL_STATE', state),
        setUserID: ({commit}: {commit: Commit}, id: number) => commit('SET_ID', id),
        setBlockRefresh: ({commit}: {commit: Commit}, block: boolean) => commit('SET_BLOCK_REFRESH', block),
        setFilterLanguages: ({commit}: {commit: Commit}, languages: any) => commit('SET_FILTER_LANGUAGES', languages),

    },
    modules: {

    },
});