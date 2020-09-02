import store from "./store/store";

Echo.join("chat")
    .here(users => {
        // console.log("online", users);
        let filtered = handleOnlineUsers(users);
        store.commit("SET_USERS", filtered);
    })
    .joining(user => {
        // console.log("joining", user);
        let users = handleUserBeforeSave(user, "joining");
        store.commit("SET_USERS", users);
    })
    .leaving(user => {
        // console.log("leaving", user);
        let users = handleUserBeforeSave(user, "leaving");
        store.commit("SET_USERS", users);
    });

export const handleUserBeforeSave = (user, action) => {
    user.online = action == "joining" ? true : false;
    let usersState = store.state.chat.users;
    usersState.unshift(user);
    let unique = getUnique(usersState, "id");
    return removeUserAuth(unique);
};

export const handleOnlineUsers = users => {
    let usersState = store.state.chat.users;

    //Set true for online users
    let onlineUsers = users.filter(item => {
        item.online = true;
        return item;
    });

    Array.prototype.unshift.apply(usersState, onlineUsers);
    let unique = getUnique(usersState, "id");
    return removeUserAuth(unique);
};

export const getUnique = (arr, comp) => {
    // store the comparison  values in array
    const unique = arr
        .map(e => e[comp])

        // store the indexes of the unique objects
        .map((e, i, final) => final.indexOf(e) === i && i)

        // eliminate the false indexes & return unique objects
        .filter(e => arr[e])
        .map(e => arr[e]);

    return unique;
};

export const removeUserAuth = users => {
    let userAuth = store.state.chat.userAuth;
    let filtered = users.filter(item => item.id != userAuth.id);
    return filtered;
};
