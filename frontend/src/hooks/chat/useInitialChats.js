import axios from "axios";
import { ref } from "vue";

export function useInitialChats() {
    const chats = ref([]);
    const nextChatsRef = ref('');
    const fetchMyChats = async () => {
        try{
            const response = await axios.get('http://localhost:80/api/chats/self', {
                headers:{
                    "Authorization": localStorage.getItem('api_token')
                }
            });
            chats.value = response.data.chats;
            nextChatsRef = response.data.nextRef;
        }catch (e)
        {
            console.log(e);
        }
    }

    return {
        chats, 
        nextChatsRef
    };
}