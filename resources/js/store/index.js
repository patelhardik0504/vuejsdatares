import axios from 'axios';
import { createStore } from 'vuex'
import sharedMutations from 'vuex-shared-mutations';
import Vue from 'vue';

export default createStore({
    state() {
        return {
            user: null,
             //Hardik
             submitted: false,
            approved: false,
        }
    },
    getters: {
        user(state) {
            return state.user;
        },
        verified(state) {
            if (state.user) return state.user.email_verified_at
            return null
        },
        id(state) {
            if (state.user) return state.user.id
            return null
        },
        formSubmissionState(state) {
            return {
                submitted: state.submitted,
                approved: state.approved,
            };
        }
    },
    mutations: {

        setUser(state, payload) {
            state.user = payload;
        },

        //Hardik
        setFormSubmissionState(state, { submitted, approved }) {
            state.submitted = submitted;
            state.approved = approved;
        }

    },

    actions: {

        async login({ dispatch }, payload) {
            try {
                await axios.get('/sanctum/csrf-cookie');

                await axios.post('/api/login', payload).then((res) => {
                    return dispatch('getUser');
                }).catch((err) => {
                    throw err.response
                });
                // const res = await axios.post('/api/login', payload);

                // if (res.status != 200) throw res;

                // if (res.data.status_code != 200) throw res.data.message;
                
                
                
            } catch (e) {
                throw e
            }
    
        },

        async register({ dispatch }, payload) {
            try {

                await axios.post('/api/register' , payload).then((res) => {
                    return dispatch('login' , { 'email' : payload.email , 'password' : payload.password})
                }).catch((err) => {
                    throw(err.response)
                })
            } catch (e) {
                throw (e)
            }
        },
        async logout({ commit }) {
                await axios.post('/api/logout').then((res) => {
                    commit('setUser', null);
                }).catch((err) => {
                    
                })
            
        },
        async getUser({ commit }) {
            try {
                const response = await axios.get('/api/user');
               
                const user = response.data.user;
                // const form = response.data.form;
              let form =true;
     
                commit('setUser', user);

                
                
                // var fin = form.is_approved == 0 ? false : true;
             
                var fin = true;
                if (form) {
                  commit('setFormSubmissionState', {
                    submitted: true,
                    approved: fin,
                  });
                } else {
                   
                  commit('setFormSubmissionState', { submitted: false, approved: false });
                }
              } catch (error) {
                console.error('Error fetching user:', error);
                commit('setUser', null);
                commit('setFormSubmissionState', { submitted: false, approved: false });
              }
        },
        async profile({commit},payload) {
            await axios.patch('/api/profile', payload).then((res) => {
                commit('setUser', res.data.user);
            }).catch((err) => {
                throw err.response
            })
        },
        async password({commit},payload) {
            await axios.patch('/api/password', payload).then((res) => {
                
            }).catch((err) => {
                throw err.response
            })
        },

        async verifyResend({dispatch} , payload){
            let res = await axios.post('/api/verify-resend' , payload)
            if (res.status != 200) throw res
            return res
        },
        async verifyEmail({dispatch} , payload){
            let res = await axios.post('/api/verify-email/' + payload.id + '/' + payload.hash)
            if (res.status != 200) throw res
            dispatch('getUser')
                return res
            
        },
//Hardik
        async checkFormSubmission({ commit }) {
            try {
              const response = await axios.get('/api/forms/user');
              if (response.data) {
                commit('setFormSubmissionState', {
                  submitted: true,
                  approved: response.data.is_approved,
                });
              }
            } catch (error) {
              commit('setFormSubmissionState', { submitted: false, approved: false });
            }
        },
        


    },
    plugins: [sharedMutations({ predicate: ['setUser'] })],


})
