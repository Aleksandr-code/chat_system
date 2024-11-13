import {reactive} from "vue";
import axios from "axios";

const _auth = reactive({
    isAuthenticated:false,
    user: {}
})

// case: refresh page
const isLoggedin = localStorage.getItem('isLoggedin')
if(isLoggedin){
    axios.get('/api/user').then(res => {
            _auth.isAuthenticated = true
            _auth.user = res.data
    }).catch( error => {
            console.log(error.data)
    })
}

function useAuth(){
    return _auth
}

export default useAuth;
