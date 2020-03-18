let feedbackCountEl = document.getElementById('feedbackCount');

// establish stream and log responses to the console
const es = new EventSource("/admin/default/get-new-feedback");
let listener = function (event) {

    if(typeof event.data !== 'undefined'){
        console.log('Last-Event-Id: ' + event.lastEventId);
        console.log('Ready State: ' + es.readyState);
        console.log("typeof: event.data", typeof event.data);
        console.dir(event);

        feedbackCountEl.textContent = event.data;
        feedbackCountEl.style.backgroundColer = '#1e8246';
    }

};
es.addEventListener("open", function(e){
    console.log('Connection open.');
});
es.addEventListener("message", listener);
es.addEventListener("error", listener);