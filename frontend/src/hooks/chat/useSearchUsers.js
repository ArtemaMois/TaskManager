import axios from "axios";
import {  ref } from "vue";

export function useSearchUsers(query) {
    const users = ref([]);
    const nextRef = ref('');
    const fetchUsers = async () => {
        try {
            const response = await axios.get('http://localhost/api/accounts/chat?search=' + query, {
                headers: {
                    "Authorization": localStorage.getItem("api_token")
                }
            });
            users.value = response.data.data.users;
            nextRef.value = response.data.nextPageRef;
        } catch (e) {
            console.log(e);
        }
    }
    fetchUsers();
    return {
        users,
        nextRef
    };

}