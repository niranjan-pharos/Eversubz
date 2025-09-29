<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/html5-qrcode"></script> <!-- Include Scanner Library -->
    <style>
        #reader {
            width: 300px;
            margin: auto;
        }
        .ticket-info {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            display: none;
        }
    </style>
</head>
<body>

    <h2>Scan Ticket QR Code</h2>
    <div id="reader"></div>

    <div class="ticket-info" id="ticket-info">
        <h3>Ticket Details</h3>
        <p><strong>Order ID:</strong> <span id="order_id"></span></p>
        <p><strong>User Name:</strong> <span id="user_name"></span></p>
        <p><strong>Event Name:</strong> <span id="event_name"></span></p>
        <p><strong>Event Date:</strong> <span id="event_date"></span></p>
        <h4>Tickets:</h4>
        <ul id="ticket_list"></ul>
    </div>
    <h3>Upload a QR Code Image</h3>
    <input type="file" id="qr-input-file" accept="image/*">
    <p id="upload-error" style="color: red; display: none;">Could not read the QR code from the image.</p>

    <script>
    function onScanSuccess(decodedText, decodedResult) {
        console.log("QR Code Scanned:", decodedText);

        try {
            let ticketData = JSON.parse(decodedText);

            document.getElementById("order_id").innerText = ticketData.order_id ?? "N/A";
            document.getElementById("user_name").innerText = ticketData.user_name.trim() !== "" ? ticketData.user_name : "Not Provided";
            document.getElementById("event_name").innerText = ticketData.event_name ?? "Unknown Event";
            document.getElementById("event_date").innerText = new Date(ticketData.event_date).toLocaleString();

            let ticketList = document.getElementById("ticket_list");
            ticketList.innerHTML = ""; 
            
            if (ticketData.tickets && ticketData.tickets.length > 0) {
                ticketData.tickets.forEach(ticket => {
                    let li = document.createElement("li");
                    li.innerHTML = `<strong>${ticket.quantity}x ${ticket.name} (${ticket.type})</strong> - $${ticket.price}`;
                    ticketList.appendChild(li);
                });
            } else {
                ticketList.innerHTML = "<li>No tickets found.</li>";
            }

            document.getElementById("ticket-info").style.display = "block";

        } catch (error) {
            console.error("Error parsing QR code:", error);
            alert("Invalid QR Code scanned. Please try again.");
        }
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: { width: 250, height: 250 }
    });

    html5QrcodeScanner.render(onScanSuccess);

    document.getElementById('qr-input-file').addEventListener('change', function(event) {
        let file = event.target.files[0];
        if (!file) {
            return;
        }

        let reader = new FileReader();
        reader.onload = function() {
            let imageData = reader.result;
            Html5QrcodeScanner.scanFile(imageData, false)
                .then(onScanSuccess)
                .catch(err => {
                    console.error("QR Code Read Error:", err);
                    document.getElementById("upload-error").style.display = "block";
                });
        };
        reader.readAsDataURL(file);
    });
</script>

    
    

</body>
</html>
