<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Toast Notification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            background: #ccc;
            margin: 0;
            font-family: sans-serif;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 100vh;
        }

        .toast {
            position: fixed;
            top: 25px;
            right: 25px;
            width: 375px;
            background: #FFF;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            /*   gap: 20px; */
            border-radius: 12px;
            border-left: 3px solid red;
            overflow: hidden;
            transform: translateX(calc(100% + 25px));
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35)
        }

        .toast.active {
            transform: translateX(0);
        }

        .toast i:first-child {
            color: red;
            font-size: 20px;
        }

        .toast-text {
            margin: 0;
            font-size: .8125rem;
            text-transform: uppercase;
        }

        .toast i:last-child {
            color: #ccc;
            cursor: pointer;
            transition: 350ms;
        }

        .toast i:last-child:hover {
            color: #333;
        }

        button {
            border: none;
            outline: none;
            background: #343434;
            padding: 1em;
            font-size: 1em;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 6px;
            cursor: pointer;
            transition: 350ms;
        }

        button:hover {
            background: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="toast" id="toast">
            <i class="fas fa-exclamation-circle"></i>
            <p class="toast-text">Oops, Wrong email or password!</p>
            <i class="fas fa-close" id="close"></i>
        </div>
        <button id="open">Open</button>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="vehicle/kenny-eliason-yDekvyZ52dU-unsplash.jpg" class="card-img-top" alt="Car Image">
            <div class="card-body">
                <h5 class="card-title">Booking Request</h5>
                <p class="card-text"><strong>Vehicle:</strong> Toyota Camry</p>
                <p class="card-text"><strong>Dates:</strong> August 1st, 2022 - August 10th, 2022</p>
                <p class="card-text"><strong>Pick-up Location:</strong> John F. Kennedy International Airport</p>
                <p class="card-text"><strong>Drop-off Location:</strong> LaGuardia Airport</p>
                <button type="button" class="btn btn-success mr-3">Accept</button>
                <button type="button" class="btn btn-danger">Reject</button>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="vehicle/talia-sBPnD3jzQ7g-unsplash.jpg" class="card-img-top" alt="Car Image">
            <div class="card-body">
                <h5 class="card-title">Booking Request</h5>
                <p class="card-text"><strong>Vehicle:</strong> BMW X5</p>
                <p class="card-text"><strong>Dates:</strong> September 10th, 2022 - September 15th, 2022</p>
                <p class="card-text"><strong>Pick-up Location:</strong> Chicago O'Hare International Airport</p>
                <p class="card-text"><strong>Drop-off Location:</strong> Midway International Airport</p>
                <button type="button" class="btn btn-success mr-3">Accept</button>
                <button type="button" class="btn btn-danger">Reject</button>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        const openBtn = document.getElementById("open");
        const toast = document.getElementById("toast");
        const closeBtn = document.getElementById("close");

        openBtn.addEventListener("click", () => {
            toast.classList.add("active");
            setTimeout(() => {
                toast.classList.remove("active");
            }, 5000)
        })

        closeBtn.addEventListener("click", () => {
            toast.classList.remove("active");
        })
    </script>
</body>

</html>