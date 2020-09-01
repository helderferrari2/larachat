<template>
    <div class="user_list">
        <div class="ml-3">
            <h4 class="text-primary">Contacts</h4>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item" v-for="user in users" :key="user.id">
                <a
                    :class="{
                        'nav-link': true,
                        active: receiver_user_id === user.id
                    }"
                    @click.prevent="setReceiverUserId(user.id)"
                >
                    <div class="user_chat">
                        <div class="user_avatar">
                            <img
                                :src="[`${handleUserAvatar(user.avatar)}`]"
                                alt="user-image"
                                class="rounded-circle"
                            />
                        </div>
                        <div class="user_description">
                            <h5>{{ user.name }}</h5>
                            <h6>Online</h6>
                        </div>
                        <!-- <span class="badge badge-primary badge-pill">1</span> -->
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        users: {
            type: Array
        },

        receiver_user_id: {
            type: Number
        }
    },

    methods: {
        setReceiverUserId(user_id) {
            this.$store.dispatch("setReceiverUserId", user_id);
        },

        handleUserAvatar(avatar) {
            return avatar != null
                ? avatar
                : require("@/assets/user_no_image.png");
        }
    }
};
</script>
