<?php $contactUs = ContactUs::getInstance(); ?>
<section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
					<div class="col-md-4 contact-info ftco-animate">
						<div class="row">
							<div class="col-md-12 mb-4">
	              <h2 class="h4">Contact Information</h2>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Website:</span> <a href="#">yoursite.com</a></p>
	            </div>
						</div>
					</div>
					<div class="col-md-1"></div>
          <div class="col-md-6 ftco-animate">
					<div id="results">
    				<ul id="list">
    					<li>Results will be displayed here.</li>
    				</ul>
    			</div>
            <form   class="contact-form">
            	<div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" name="name" id="nam" class="form-control" placeholder="Your Name"/>
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" name="email" id="email" class="form-control" placeholder="Your Email"/>
	                </div>
	                </div>
              </div>
              <div class="form-group">
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject"/>
              </div>
              <div class="form-group">
                <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="button"   value="Send Message" onClick="sendMessage()" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
      </div>
		</section>

		<script> 
	 		var ajaxRequest;
			function sendMessage() {
			
				ajaxRequest = getXMLHttpRequest();  

				if (ajaxRequest) {   //  if the object was created successfully
							var name = document.getElementById("nam").value;
							var email = document.getElementById("email").value;
							var subject = document.getElementById("subject").value;
							var message = document.getElementById("message").value;

							
							ajaxRequest.onreadystatechange = ajaxResponse;  
							ajaxRequest.open("GET", "classes/submitMessage.php?name=" + name + "&email=" +email+"&subject="+subject+"&message="+message);
							ajaxRequest.send(null);
				}
			}
       window.onload = sendMessage;

			function getXMLHttpRequest() {
				var request, err;
				try {
								request = new XMLHttpRequest();   // Firefox, Safari, Opera, etc.
						}
				catch(err) {
						try {             //  first attempt for Internet Explorer
								request = new ActiveXObject("MSXML2.XMLHttp.6.0");
								}
						catch (err) {
														try {    //  second attempt for Internet Explorer
														request = new ActiveXObject("MSXML2.XMLHttp.3.0");
																}
														catch (err) {
																request = false;  // oops, can’t create one!  
																				}
												}
										}
				return request;  
			}

			
			function ajaxResponse()  {
				
				if (ajaxRequest.readyState != 4)  //  check to see if we're done
						{  return;  }
				else {
						if (ajaxRequest.status == 200) //  check to see if successful
								{  
									 displaySearchResults();   }
						else {
						alert("Request failed: " + ajaxRequest.statusText);
								}
						}
    	}

    function displaySearchResults()  { 
			var i, n, li, t;
    var ul = document.getElementById("list");
    var div = document.getElementById("results");

    // div.removeChild(ul);  //  delete the old search results
		while (div.hasChildNodes()) {
    	div.removeChild(div.lastChild);
		}
    ul = document.createElement("UL");  //  create a new list container
    ul.id="list";

    //  get the results from the search request object
		var parser = new DOMParser();
    var doc = parser.parseFromString(ajaxRequest.responseXML, 'application/xml');
    
    var names=ajaxRequest.responseXML.getElementsByTagName("name");
    for (i = 0; i < names.length; i++)
        {
            li = document.createElement("LI");  //  create a new list element
            n = names[i].firstChild.nodeValue;
            li.appendChild(document.createTextNode(n));         
            ul.appendChild(li);
        }

    div.appendChild(ul);  // display the new list
    }


		</script>

		
		