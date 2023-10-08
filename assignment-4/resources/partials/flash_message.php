<?php

    use App\Http\Session;

    $message = Session::get('response') ?? null;

    if($message) {
        echo <<<EOL
            <dialog class='dialog' close>
                $message
                <hr>
                <button type="button">CLOSE</button>
            </dialog>
        EOL;
    }

    Session::forget('response');
?>

<style>
    .dialog {
        color: #444;
        box-shadow: 0 0 5px rgba(0, 0, 0, .5);
        border: 1px solid #ccc;
        text-align: center;
        width: 320px;
        padding: 10px;
    }

    .dialog > button {
        width: 100%;
        display: block;
        background: #2196F3;
        color: #fff;
        padding: 5px;
        margin-top: 5px;
        font-size: 0.9em;
        outline: none;
    }

    .dialog::backdrop {
        background: rgba(0, 0, 0, .5);
    }

    .dialog > button:hover {
        opacity: 0.8;
    }
</style>

<script>
    const dialog = document.querySelector("dialog");
    if(dialog) {
        dialog.showModal();
        const button = dialog.querySelector("button");
        button.addEventListener("click", () => {
            document.querySelector("dialog").close();
        });
    }
</script>