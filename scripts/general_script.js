const url = new URL(window.location.toLocaleString())
let current_error = url.searchParams.get('error')
const body = document.getElementsByTagName('body')
const newDiv = document.createElement("div")

if (current_error == 'content_rated'){
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode('Rating added !'))
    body[0].appendChild(newDiv)
}
if (current_error == 'content_rating_updated'){
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode('Rating updated !'))
    body[0].appendChild(newDiv)
}
if (current_error == 'need_to_log_in'){
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode('Login to use this feature !'))
    body[0].appendChild(newDiv)
}
if (current_error == 'user_created'){
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode('User created !'))
    body[0].appendChild(newDiv)
}
if (current_error == 'logged_in'){
    username = document.querySelector("[href='profile.php']").innerText
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode(`Welcome, ${username}!`))
    body[0].appendChild(newDiv)
}
if (current_error == 'logged_out'){
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode('Logged out !'))
    body[0].appendChild(newDiv)
}
if (current_error == 'content_removed'){
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode('Content has been removed !'))
    body[0].appendChild(newDiv)
}
if (current_error == 'rating_removed'){
    newDiv.setAttribute("class", "general-error")
    newDiv.appendChild(document.createTextNode('Rating has been removed !'))
    body[0].appendChild(newDiv)
}