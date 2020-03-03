<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/StickyNote.php');

/**
 * Used to provide a dao interface to interact with a user/sticky notes tables.
 */
interface UserStickyNotesDAOInterface {

    public function createUser(User $user);
    
    public function getUser(string $username);
    
    public function createSticky(StickyNote $note);

    public function getStickyNotesOfUser(string $user) : array; 

    public function updateStickyLocation(int $noteId, int $newTop, int $newLeft);

    public function deleteSticky(int $noteId);
    
    public function incrementInvalidLoginAttempts(User $user);
    
    public function updateLoginLastAttempt(User $user);
    
    public function resetInvalidLoginAttempts(User $user);
    
}
