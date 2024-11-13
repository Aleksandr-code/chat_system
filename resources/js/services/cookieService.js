// Maybe store the token in a cookie

function getCookie() {
    return document.cookie.split('; ').reduce((acc, item) => {
        const [name, value] = item.split('=')
        acc[name] = value
        return acc
    }, {})
}

function getToken(){
    let cookie = getCookie()
    if(cookie["XSRF-TOKEN"]){
        return cookie["XSRF-TOKEN"].slice(0,-3)
    }
}

export default {getCookie, getToken}
