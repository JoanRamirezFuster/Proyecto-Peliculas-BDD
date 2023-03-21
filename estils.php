<html>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        cursor: crosshair;
        scroll-behavior: smooth;
    }

    body {
        background-color: white;
        background-image: url(https://wallpaperaccess.com/full/3658604.jpg);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
    }

    header {
        text-align: center  ;
        width: 100%;
        background-color: white;
        padding: 30px;
        box-shadow: rgba(0, 0, 0, 0.7) 0px 5px 15px;
        margin-bottom: 40px;
    }

    header ul {
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px;
        width: 85%;
        margin: auto;
    }

    header ul li .nom {
        align-items: center;
        margin-bottom: 40px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    header ul li .nom h1 {
        color: black;
        font-size: 2.5rem;
    }

    header ul li a {
        text-decoration: none;
        color: black;
        padding: 10px;
        font-size: 1.3rem;
        transition: all 1s;
        border-radius: 10px;
    }

    header ul li a:hover {
        color: white;
        background-color: black;
        transition: all 1s;
        border-radius: 30px 10px;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    td {
        background-color: white;
        color: black;
        padding: 30px;
        font-size: 1.5rem;
        text-align: center;
        box-shadow: rgba(0, 0, 0, 0.7) 0px 5px 15px;
        border-radius: 10px;
    }

    th {
        background-color: black;
        color: white;
        padding: 30px;
        font-size: 2rem;
        text-align: center;
        margin-top: 50px;
        box-shadow: rgba(0, 0, 0, 0.7) 0px 5px 15px;
        border-radius: 10px;
    }

    td a {
        text-decoration: none;
        color: black;
        transition: all 2s;
    }

    td a:hover {
        text-decoration: underline 3px;
    }

    table button {
        background-color: #FF0000;
        color: white;
        padding: 30px;
        font-size: 1.5rem;
        border-radius: 10px;
        transition: all 1s;
    }

    table button:hover {
        text-decoration: underline 3px;
    }

    form {
        margin-top: 50px;
        color: black;
        background-color: whitesmoke;
        font-size: 2rem;
        padding: 100px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 60px;
        box-shadow: rgba(0, 0, 0, 0.7) 0px 5px 15px;
    }

    form h1 {
        margin-bottom: 10px;
    }

    form input {
        padding: 20px;
        border-radius: 10px;
        width: 100%;
        border: 3px solid black;
    }

    form p {
        color: red;
        font-size: 1rem;
        margin-bottom: 50px;
    }

    form select {
        padding: 20px;
        border-radius: 10px;
        width: 100%;
        border: 3px solid black;
    }

    .intro {
        color: black;
        background-color: white;
        padding: 50px;
        border-radius: 10px;
        margin-top: 50px;
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: rgba(0, 0, 0, 0.7) 0px 5px 15px;
    }

    .intro h1 {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .intro p {
        font-size: 1.5rem;
    }

    .intro img {
        border-radius: 20px 40px;
        margin-top: 20px;
        width: 500px;
        box-shadow: rgba(0, 0, 0, 0.7) 0px 5px 15px;
        transition: all 1s;
    }

    .intro img:hover {
        border-radius: 100px;
        border: 5px solid black;
        width: 600px;
        overflow: hidden;
    }

    footer {
        margin-top: 24px;
        width: 100%;
        background-color: white;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    footer h1 {
        color: black;
        margin-bottom: 20px;
    }

    footer p {
        font-size: 1.3rem;
        color: black;
        margin-bottom: 20px;
    }

    footer button {
        background-color: black;
        padding: 10px;
        font-size: 1.5rem;
        border-radius: 10px;
        border: solid white 5px;
        transition: all 1s;
    }

    footer button:hover {
        background-color: black;
        color: black;
        border-radius: 10px 30px;
    }

    footer a {
        text-decoration: none;
        color: white;
    }

    .error {
        color: #FF0000;
        font-size: 2rem;
    }
</style>

</html>