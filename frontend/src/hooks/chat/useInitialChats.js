import axios from "axios";
import { ref } from "vue";

export function useInitialChats() {
    const chats = ref([]);
    const nextChatsRef = ref('');
    const fetchMyChats = async () => {
        try{
            const response = await axios.get('http://localhost/api/chats/self', {
                headers:{
                    "Authorization": localStorage.getItem('api_token')
                }
            });
            console.log(response.data.data.chats);
            response.data.data.chats.forEach(element => {
                chats.value.push(element);
            });
            nextChatsRef.value = response.data.data.nextRef;
        }catch (e)
        {
            console.log(e);
        }
    }
    fetchMyChats();
    return {
        chats, 
        nextChatsRef
    };
}