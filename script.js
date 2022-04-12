console.log('The js script file has been loaded');

async function fetchWoocommerceData() {
    let url = './send-social-data.php';

    const response = await fetch(url);
    var socialDataObject = await response.json().then(function(data) {
        return data;
    }); 

    return socialDataObject;            
} 


function addEventListeners() {
    let feedbackButtons = document.querySelectorAll('.give-feedback');
    let cancelfeedbackButtons = document.querySelectorAll('.cancel-feedback');
    let feedbackContainers = document.querySelectorAll('.feedback-container');
    let charCountDowns = document.querySelectorAll('.char-countdown');
    let feedBackTextArea = document.querySelectorAll('.feedback-textarea');
    
    

    console.log(feedbackButtons);
    for (let i=0; i < feedbackButtons.length; i++) {
        feedbackButtons[i].addEventListener('click', function() {
        feedbackContainers[i].classList.toggle('feedback-container-height');
        
        });
    }
    
    for (let i=0; i < cancelfeedbackButtons.length; i++) {
        cancelfeedbackButtons[i].addEventListener('click', function() {
        feedbackContainers[i].classList.remove('feedback-container-height');
        
        });
    }

    for (let i=0; i < cancelfeedbackButtons.length; i++) {
        cancelfeedbackButtons[i].addEventListener('click', function() {
        feedbackContainers[i].classList.remove('feedback-container-height');
        
        });
    }
    for (let i=0; i < feedBackTextArea.length; i++) {        
        feedBackTextArea[i].oninput = function() {
            console.log('changin..');
            let remaining = 750 - feedBackTextArea[i].value.length;
            charCountDowns[i].querySelector('span').innerText = remaining;
            //console.log( document.querySelector('.feedback-textarea').value.length );
        }
    
    }

    
}


/* document.querySelector('.feedback-textarea').oninput = function() {
    let remaining = 750 - document.querySelector('.feedback-textarea').value.length;
    document.querySelector('.char-countdown').querySelector('span').innerText = remaining;
    console.log( document.querySelector('.feedback-textarea').value.length );
    //console.log('happening')
} */

/* document.querySelector('.cancel-feedback').addEventListener('click', function(){
    console.log('clicked');
    document.querySelector('.feedback-container').classList.remove('feedback-container-height');
    //document.querySelector('.feedback-container').classList.add('animate');
}); */

function updateDOM(result) {

    console.log(result[0].date);
    for (let i = 0; i < result.length; i++){
        var tempDiv = document.createElement('main-post');
        tempDiv.setAttribute("class", "real post-" +i+ "");
        tempDiv.setAttribute("data-date", "" + result[i].date  + "");
        tempDiv.setAttribute("data-copy", "" + result[i].copy  + "");
        tempDiv.setAttribute("data-img-url", "" + result[i].img_url  + "");
        tempDiv.setAttribute("data-text-url", "" + result[i].text_url  + "");
        tempDiv.setAttribute("data-promoted", "" + result[i].promoted  + "");
        
        document.querySelector('.main-feed-list').insertAdjacentElement('beforeend', tempDiv);
    }
    
    let posts = document.querySelectorAll('.real');

    for (let i = 0; i < posts.length; i++){
        posts[i].querySelector('.common-content').querySelector('p').innerText = result[i].copy;
        posts[i].querySelector('.time-and-privacy').querySelector('time').innerText = result[i].date;
        posts[i].querySelector('.common-content').querySelector('img').src = result[i].img_url;
    }

    //posts.querySelector('.post-4').querySelector('.common-content').querySelector('p').innerText = posts.querySelector('.post-4').getAttribute('data-copy');
    //let onePost = posts.childNodes[0];
    //console.log(result[0].copy);
    //let copyValue = 
    //console.log(posts[0].setAttribute('data-copy', result[0].copy) );

    //posts[0].querySelector('.common-content').querySelector('p').innerText = result[1].copy;
}

let socialDataObject = fetchWoocommerceData();
socialDataObject.then(function(result) {
    console.log(result);
    //hideLoading(); 
    updateDOM(result);
    //console.log(result[0].date);
    addEventListeners();
});




/* document.querySelector('.give-feedback').addEventListener('click', function(){
    console.log('clicked');
    document.querySelector('.feedback-container').classList.add('feedback-container-height');
    //document.querySelector('.feedback-container').classList.add('animate');
}); */



/* document.querySelector('.feedback-textarea').oninput = function() {
    let remaining = 750 - document.querySelector('.feedback-textarea').value.length;
    document.querySelector('.char-countdown').querySelector('span').innerText = remaining;
    console.log( document.querySelector('.feedback-textarea').value.length );
    //console.log('happening')
} */


