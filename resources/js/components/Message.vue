<template>
    <div class="chat-body" ref="scrollMessages">
        <div v-for="item in messages" :key="item.id">
            <div
                class="main_message"
                :class="{ 'justify-content-end': item.owner }"
            >
                <div class="message_avatar" v-if="!item.owner">
                    <img
                        :src="[`${handleUserAvatar(item.receiver.avatar)}`]"
                        alt="user-image"
                        class="rounded-circle"
                    />
                </div>
                <div class="message_body">
                    <div
                        class="message_content"
                        :class="{ owner_message: item.owner }"
                    >
                        {{ item.message }}
                    </div>
                    <div class="message_created">
                        <span>{{
                            item.created_at | moment("YYYY-MM-DD hh:mm:ss")
                        }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["messages"],

    watch: {
        messages() {
            this.scrollToBottom();
        }
    },

    methods: {
        scrollToBottom() {
            setTimeout(() => {
                let el = this.$refs.scrollMessages;
                el.scroll({
                    left: 0,
                    top: el.scrollHeight,
                    behavior: "smooth"
                });
            }, 10);
        },

        handleUserAvatar(avatar) {
            return avatar ?? null;
        }
    }
};
</script>
