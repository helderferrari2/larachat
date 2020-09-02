<template>
    <div class="main">
        <div class="main__sidebar">
            <!--Filter-->
            <div class="sidebar_filter">
                <div class="input-group">
                    <input
                        class="form-control py-2 border-right-0 border"
                        type="search"
                        placeholder="Search"
                        v-model="filter"
                    />
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent">
                            <i class="fa fa-search"></i>
                        </div>
                    </span>
                </div>
            </div>
            <!--End Filter-->

            <!--Users List-->
            <user-component
                :users="users"
                :receiver_user_id="receiver_user_id"
            ></user-component>
            <!--End Users List-->
        </div>

        <!--Message-->
        <div class="main__body">
            <div class="chat-wrapper">
                <message-component :messages="messages"></message-component>
                <div class="chat-footer">
                    <textarea
                        class="form-control"
                        rows="1"
                        v-model="message"
                        @keydown="handleKeydownMessage"
                        :disabled="!receiver_user_id"
                    ></textarea>
                </div>
            </div>
        </div>
        <!--End Message-->
    </div>
</template>

<script>
import UserComponent from "../components/User";
import MessageComponent from "../components/Message";

export default {
    props: ["user"],
    components: {
        UserComponent,
        MessageComponent
    },

    data() {
        return {
            filter: "",
            message: "",
            loading: false
        };
    },

    computed: {
        receiver_user_id() {
            return this.$store.state.chat.receiver_user_id;
        },

        conversation() {
            return { receiver_user_id: this.receiver_user_id };
        },

        messages() {
            return this.$store.state.chat.messages;
        },

        users() {
            return this.$store.state.chat.users;
        }
    },

    created() {
        this.fetchUsers();
        this.setUserAuth();

        Echo.private(`privateChat.${this.user.id}`).listen("MessageSent", e => {
            this.$store.dispatch("setMessage", e.message);
        });
    },

    watch: {
        receiver_user_id() {
            this.fetchMessages();
        },

        filter() {
            this.searchUsers();
        }
    },

    methods: {
        handleKeydownMessage(e) {
            //If press enter without combine with shift, send message
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
                this.clearMessage();
            }
        },

        sendMessage() {
            this.loading = true;
            this.$store
                .dispatch("storeMessage", {
                    ...this.conversation,
                    message: this.message
                })
                .then(() => (this.loading = false))
                .catch(() => (this.loading = false));
        },

        clearMessage() {
            this.message = "";
        },

        setUserAuth() {
            this.$store.dispatch("setUserAuth", this.user);
        },

        fetchMessages() {
            this.$store.dispatch("clearMessages");
            this.loading = true;
            this.$store
                .dispatch("fetchMessages", { ...this.conversation })
                .then(() => (this.loading = false))
                .catch(() => (this.loading = false));
        },

        fetchUsers() {
            this.$store.dispatch("fetchUsers");
        },

        searchUsers() {
            this.$store
                .dispatch("searchUsers", this.filter)
                .then(() => (this.loading = false))
                .catch(() => (this.loading = false));
        }
    }
};
</script>
