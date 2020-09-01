import Axios from "axios";

export default {
    state: {
        userAuth: {},
        users: [],
        messages: [],
        receiver_user_id: null
    },

    mutations: {
        SET_USER_AUTH(state, payload) {
            state.userAuth = payload;
        },
        SET_USERS(state, payload) {
            state.users = payload;
        },
        SET_RECEIVER_USER_ID(state, payload) {
            state.receiver_user_id = payload;
        },
        SET_MESSAGE(state, payload) {
            state.messages.push(payload);
        },
        SET_MESSAGES(state, payload) {
            state.messages = payload;
        },
        CLEAR_MESSAGES(state) {
            state.messages = [];
        }
    },

    actions: {
        getUserAuth(context) {
            return new Promise((resolve, reject) => {
                return axios
                    .get("user/auth")
                    .then(response => {
                        context.commit("SET_USER_AUTH", response.data.data);
                        resolve();
                    })
                    .catch(() => reject());
            });
        },

        fetchUsers(context) {
            return new Promise((resolve, reject) => {
                return axios
                    .get("user")
                    .then(response => {
                        context.commit("SET_USERS", response.data.data);
                        resolve();
                    })
                    .catch(() => reject());
            });
        },

        searchUsers(context, params) {
            return new Promise((resolve, reject) => {
                return axios
                    .get(`user/search?search=${params}`)
                    .then(response => {
                        context.commit("SET_USERS", response.data.data);
                        resolve();
                    })
                    .catch(() => reject(context.commit("SET_USERS", [])));
            });
        },

        fetchMessages(context, params) {
            return new Promise((resolve, reject) => {
                return axios
                    .post("chat/search", params)
                    .then(response => {
                        context.commit("SET_MESSAGES", response.data.data);
                        resolve();
                    })
                    .catch(() => reject());
            });
        },

        storeMessage(context, params) {
            return new Promise((resolve, reject) => {
                return axios
                    .post("chat", params)
                    .then(response => {
                        context.commit("SET_MESSAGE", response.data.data);
                        resolve();
                    })
                    .catch(() => reject());
            });
        },

        setReceiverUserId(context, user_id) {
            return context.commit("SET_RECEIVER_USER_ID", user_id);
        },

        clearMessages(context) {
            return context.commit("CLEAR_MESSAGES");
        }
    }
};
