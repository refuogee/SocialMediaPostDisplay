console.log('The js assets script has been loaded');

class Post extends HTMLElement {
connectedCallback() {
        this.innerHTML = `    
                            <li class="main-feed-item">
                            <article class="common-post">
                            <header class="common-post-header u-flex">
                                <img src="gqb-logo.jpg" class="user-image" width="40" height="40" alt="">
                                <div class="common-post-info">
                                <div class="user-and-group u-flex">
                                    <a href="https://www.facebook.com/eladsc" target="_blank">Sk Imports</a>
                                </div>
                                <div class="time-and-privacy"><time datetime="">August 24 at 7:21 PM</time><span class="icon icon-privacy">🌎</span></div>
                                </div>
                                <button class="icon-button-2 u-margin-inline-start" aria-label="more options"><span class="icon-menu"></span></button>
                            </header>
                            <div class="common-post-content common-content">
                                <p>Hit the dirt and have some fun! GQB has the perfect ride for the entire family; visit our website today to shop safely and securely: <a href="https://gokartsquadsbikes.co.za" target="_blank">www.gokartsquadsbikes.co.za</a></p>         
                                <img class="embed-content-image" src="https://drive.google.com/uc?export=view&id=1RgMwh-2CnNip29PdCOMF9T0aoIrRMEVQ" alt="">
                            </div>
                            <div class="summary u-flex">
                                <div class="reactions">❤️</div>
                                <div class="reactions-total">28</div>
                                <div class="total-comments u-margin-inline-start">
                                <a>12 Shares</a>
                                </div>
                            </div>
                            <section class="actions-buttons">
                                <ul class="actions-buttons-list u-flex">
                                <li class="actions-buttons-item"><button class="actions-buttons-button"><span class="icon">👍</span><span class="text">Approve</span></button></li>
                                <li class="actions-buttons-item give-feedback"><button class="actions-buttons-button"><span class="icon">💬</span><span class="text">Give Feedback</span></button></li>
                                </ul>
                            </section>
                            <div class="feedback-container">
                            <p class="feedback-text">Please tell us which copy / image / image caption you'd like changed. We will make the changes and get back to you.
                            </p>
                            <textarea maxlength="750" class="feedback-textarea"></textarea>
                            <p class="char-countdown"><span>750</span> chars left
                            </p>
                            <section class="actions-buttons">
                                <ul class="actions-buttons-list u-flex">
                                <li class="actions-buttons-item"><button class="actions-buttons-button"><span class="icon">👍</span><span class="text">Send</span></button></li>
                                <li class="actions-buttons-item cancel-feedback" ><button class="actions-buttons-button"><span class="icon">💬</span><span class="text">Cancel</span></button></li>
                                
                                </ul>
                            </section>
                        </div>
                            </article>
                        </li>  
        `;
    }   
}

customElements.define('main-post', Post);

/* for (let i = 0; i < 10; i++){
    var tempDiv = document.createElement('main-post');
    tempDiv.setAttribute("class", "post-" +i+ "");
    document.querySelector('.main-feed-list').insertAdjacentElement('afterbegin', tempDiv);
} */
