<?php 

function startReadOnlySession() {
    session_start();
    session_write_close();
}
