<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Easy Print Documents</title>
    <style>
        body {
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
        }

        #warning {
            color: red;
            text-align: center;
        }

        input[type=number],
        select,
        textarea {
            width: 100%;
            padding: 8px 20px;
            margin: 8px 0;
            font-size: 1rem;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=checkbox] {
            margin-bottom: 15px;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 8px 20px;
            margin: 8px 0;
            font-size: 1rem;
            word-spacing: 1px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            padding: 20px 30px;
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <h3>Printing PDF documents is so easy!</h3>

    <div>
        <label for="fpage">First page:</label>
        <input type="number" id="fpage">

        <label for="lpage">Last page:</label>
        <input type="number" id="lpage">

        <label for="side">Page side:</label>
        <select id="side">
            <option value="front">Front</option>
            <option value="back">Back</option>
        </select>

        <label for="reverse">
            <input type="checkbox" id="reverse"> Reverse pages
        </label>

        <input type="submit" id="submit" onclick="displayPages()" value="Generate pages">

        <!-- Display warnings -->
        <p id="warning"></p>

        <!--Results-->
        <h3>Copy and paste text below into PDF input field:</h3>
        <textarea id="result" rows="10" placeholder="Pages will appear here..."></textarea>
    </div>

    <script>
        function displayPages() {
            var first_page = parseInt(document.getElementById("fpage").value, 10);
            var last_page = parseInt(document.getElementById("lpage").value, 10);
            var page_side = document.getElementById("side").value;
            var reversed = document.getElementById("reverse").checked;
            var warnings = document.getElementById('warning');
            var results = document.getElementById("result");

            warnings.innerHTML = "";
            results.value = "";

            var front_pages = [],
                back_pages = [];


            /* Validating inputs: */
            if (!first_page || !last_page) {
                warnings.innerHTML = "Please provide first and last page.";
                return false;
            }

            if ((last_page - first_page + 1) % 4 != 0) {
                warnings.innerHTML = "Difference of pages not dividable by 4.";
                return false;
            }



            var page, next_page, counter = 1;

            for (page = first_page; page <= last_page; page += 2) {

                next_page = page + 1;

                if (counter == 3) {
                    counter = 1;
                }

                if (counter == 1) {
                    front_pages.push(page + '-' + next_page);
                } else {
                    back_pages.push(page + '-' + next_page);
                }

                // console.log('COUNTER: ' + counter + '; PAGE: ' + page);

                counter++;
            }


            /* Reverse order */
            if (reversed) {
                front_pages.reverse();
                back_pages.reverse();
            }


            /*
                Printing the results:
            */
            if (page_side == 'front') {
                results.value = front_pages.join(", ");
            } else {
                results.value = back_pages.join(", ");
            }


            /* Debugging */
            console.log("First page: " + first_page);
            console.log("Last page: " + last_page);
            console.log("Side: " + page_side);
            console.log("Reversed: " + reversed);

            console.log(front_pages);
            console.log(back_pages);
            console.log("--");
        }
    </script>
</body>

</html>