<?php

Route::group(['middleware' => ['auth:api']], function () {
    // Administrator routes
    Route::post('/admin/check', 'AdminController@isAdministrator'); // checked 
    Route::get('/admin/users', 'AdminController@indexUsers'); // checked 
    Route::get('/admin/comments', 'AdminController@indexComments'); // checked 
    Route::get('/admin/channels', 'AdminController@indexChannels'); // checked 
    Route::get('/admin/channels/inactive', 'AdminController@inactiveChannels'); // checked
    Route::get('/admin/submissions', 'AdminController@indexSubmissions'); // checked 
    Route::get('/admin/suggested-channels', 'SuggestionController@index'); // checked 
    Route::post('/admin/suggested-channels', 'SuggestionController@store'); // checked 
    Route::delete('/admin/suggested-channels/{suggested}', 'SuggestionController@destroy'); // checked 
    Route::get('/admin/reports/comments', 'AdminController@reportedComments'); // checked 
    Route::get('/admin/reports/submissions', 'AdminController@reportedSubmissions'); // checked 
    Route::get('/admin/activities', 'AdminController@activities'); // checked 
    Route::get('/admin/echo', 'AdminController@echoServer'); // checked 
    Route::get('/admin/statistics', 'AdminController@statistics'); // checked 

    // feedback
    Route::get('/feedbacks/{feedback}', 'FeedbacksController@get')->middleware('voten-administrator'); // checked
    Route::get('/feedbacks', 'FeedbacksController@index')->middleware('voten-administrator'); // checked
    Route::post('/feedbacks', 'FeedbacksController@store')->middleware('shadow-ban'); // checked
    Route::delete('/feedbacks/{feedback}', 'FeedbacksController@destroy')->middleware('voten-administrator'); // checked

    // user
    Route::get('/users/store', 'StoreController@index'); // checked 
    Route::delete('/users', 'UserController@destroyAsAuth'); // checked 
    Route::delete('/admin/users', 'UserController@destroyAsVotenAdministrator')->middleware('voten-administrator'); // checked 
    Route::patch('/users/profile', 'UserSettingsController@profile'); // checked 
    Route::patch('/users/account', 'UserSettingsController@account'); // checked 
    Route::patch('/users/email', 'UserSettingsController@email'); // checked 
    Route::patch('/users/password', 'UserSettingsController@password'); // checked 
    Route::post('/auth/avatar', 'PhotoController@userAvatar')->middleware('shadow-ban'); // checked    
    Route::get('/users/submissions/likeds', 'UserController@likedSubmissions'); // checked 
    Route::post('/email/verify/resend', 'Auth\VerificationController@resendVerifyEmailAddress'); // checked 
    Route::post('/users/clientside-settings', 'ClientsideSettingsController@store'); // checked 
    Route::get('/users/clientside-settings', 'ClientsideSettingsController@get'); // checked 
    Route::post('/users/{user}/bookmark', 'BookmarksController@bookmarkUser'); // checked 
    Route::get('/users/bookmarked', 'BookmarksController@getBookmarkedUsers'); // checked 
    Route::post('/users/{user}/block', 'BlockUsersController@block'); // checked 

    // submission
    Route::post('/submissions', 'SubmissionController@store')->middleware('shadow-ban'); // checked 
    Route::patch('/submissions/{submission}', 'SubmissionController@patchTextSubmission'); // checked 
    Route::delete('/submissions/{submission}', 'SubmissionController@destroy'); // checked 
    Route::post('/submissions/{submission}/hide', 'BlockSubmissionsController@store'); // checked 
    Route::delete('/submissions/{submission}/hide', 'BlockSubmissionsController@destroy'); // checked 
    Route::get('/links/title', 'SubmissionController@getTitleAPI'); // checked 
    Route::post('/submissions/{submission}/nsfw', 'NsfwController@store'); // checked 
    Route::delete('/submissions/{submission}/nsfw', 'NsfwController@destroy'); // checked 
    Route::delete('/submissions/{submission}/thumbnail', 'SubmissionController@removeThumbnail'); // checked 
    Route::post('/submissions/{submission}/like', 'SubmissionLikesController@like'); // checked
    Route::post('/submissions/{submission}/bookmark', 'BookmarksController@bookmarkSubmission'); // checked 
    Route::get('/submissions/bookmarked', 'BookmarksController@getBookmarkedSubmissions'); // checked 
    Route::post('/submissions/{submission}/approve', 'ModeratorController@approveSubmission'); // checked 
    Route::post('/submissions/{submission}/disapprove', 'ModeratorController@disapproveSubmission'); // checked 
    Route::post('/submissions/{submission}/report', 'ReportSubmissionsController@store')->middleware('shadow-ban'); // checked 

    // comment
    Route::post('/comments', 'CommentController@store')->middleware('shadow-ban'); // checked
    Route::patch('/comments/{comment}', 'CommentController@patch'); // checked
    Route::delete('/comments/{comment}', 'CommentController@destroy'); // checked
    Route::post('/comments/{comment}/like', 'CommentLikesController@like'); // checked
    Route::post('/comments/{comment}/bookmark', 'BookmarksController@bookmarkComment'); // checked
    Route::get('/comments/bookmarked', 'BookmarksController@getBookmarkedComments'); // checked  
    Route::post('/comments/{comment}/approve', 'ModeratorController@approveComment'); // checked
    Route::post('/comments/{comment}/disapprove', 'ModeratorController@disapproveComment'); // checked
    Route::post('/comments/{comment}/report', 'ReportCommentsController@store')->middleware('shadow-ban');

    // channel
    Route::post('/channels', 'ChannelController@store')->middleware('shadow-ban'); // checked
    Route::patch('/channels/{channel}', 'ChannelController@patch')->middleware('administrator'); // checked 
    Route::post('/channels/{channel}/block', 'BlockChannelsController@block'); // checked 
    Route::post('/channels/{channel}/destroy', 'ChannelController@destroy')->middleware('voten-administrator'); // checked 
    Route::post('/channels/{channel}/bookmark', 'BookmarksController@bookmarkChannel'); // checked 
    Route::get('/channels/bookmarked', 'BookmarksController@getBookmarkedChannels'); // checked 
    Route::get('/channels/discover', 'SuggestionController@discover'); // checked 
    Route::post('/channels/{channel}/subscribe', 'SubscribeController@subscribe'); // checked
    Route::get('/channels/subscribed', 'SubscribeController@index'); // checked 
    Route::post('/channels/{channel}/avatar', 'PhotoController@channelAvatar')->middleware('administrator'); // checked     
    Route::get('/suggested-channel', 'SuggestionController@get'); // checked     

    // rule
    Route::post('/channels/{channel}/rules', 'RulesController@store')->middleware('administrator'); // checked 
    Route::patch('/channels/{channel}/rules/{rule}', 'RulesController@patch')->middleware('administrator'); // checked 
    Route::delete('/channels/{channel}/rules/{rule}', 'RulesController@destroy')->middleware('administrator'); // checked 

    // block domain
    Route::get('/channels/{channel}/blocked-domains', 'BlockDomainController@indexAsChannelModerator')->middleware('moderator'); // checked 
    Route::post('/channels/{channel}/blocked-domains', 'BlockDomainController@storeAsChannelModerator')->middleware('moderator'); // checked 
    Route::delete('/channels/{channel}/blocked-domains/{domain}', 'BlockDomainController@destroyAsChannelModerator')->middleware('moderator'); // checked 
    // as voten administrator: 
    Route::get('/admin/blocked-domains', 'BlockDomainController@indexAsVotenAdministrator')->middleware('voten-administrator'); // checked
    Route::post('/admin/blocked-domains', 'BlockDomainController@storeAsVotenAdministrator')->middleware('voten-administrator'); // checked
    Route::delete('/admin/blocked-domains/{domain}', 'BlockDomainController@destroyAsVotenAdministrator')->middleware('voten-administrator'); // checked

    // ban user
    Route::post('/channels/{channel}/banned-users', 'BanController@storeAsChannelModerator')->middleware('moderator'); // checked 
    Route::get('/channels/{channel}/banned-users', 'BanController@indexAsChannelModerator')->middleware('moderator'); // checked 
    Route::delete('/channels/{channel}/banned-users/{user}', 'BanController@destroyAsChannelModerator')->middleware('moderator'); // checked 
    // as voten administrator: 
    Route::post('/admin/banned-users', 'BanController@storeAsVotenAdministrator')->middleware('voten-administrator'); // checked 
    Route::get('/admin/banned-users', 'BanController@indexAsVotenAdministrator')->middleware('voten-administrator'); // checked 
    Route::delete('/admin/banned-users/{user}', 'BanController@destroyAsVotenAdministrator')->middleware('voten-administrator'); // checked 

    // moderator 
    Route::post('/channels/{channel}/moderators', 'ModeratorController@store')->middleware('administrator'); // checked 
    Route::delete('/channels/{channel}/moderators/{user}', 'ModeratorController@destroy')->middleware('administrator'); // checked

    // message
    Route::post('/messages', 'MessagesController@store')->middleware('shadow-ban'); // checked 
    Route::get('/messages', 'MessagesController@index'); // checked 
    Route::delete('/messages', 'MessagesController@batchDestroy'); // checked  
    Route::delete('/messages/{message}', 'MessagesController@destroy'); // checked
    Route::post('/messages/{message}/read', 'MessagesController@markAsRead'); // checked

    // conversations
    Route::get('/conversations', 'ConversationsController@index'); // checked
    Route::delete('/conversations/{user}', 'ConversationsController@destroy'); // checked 
    Route::post('/conversations/{user}/read', 'ConversationsController@broadcastConversationAsRead'); // checked
    Route::get('/conversations/search', 'SearchController@conversations'); // checked

    // media 
    Route::post('/photos', 'PhotoController@store')->middleware('shadow-ban'); // checked 
    Route::get('/photos/{photo}', 'PhotoController@get'); // checked 
    // Route::post('/gifs', 'GifController@store')->middleware('shadow-ban');

    // notification
    Route::get('/notifications', 'NotificationsController@index'); // checked 
    Route::post('/notifications', 'NotificationsController@markAsRead'); // checked 

    // report
    Route::get('/channels/{channel}/comments/reported', 'ReportCommentsController@index')->middleware('moderator'); // checked
    Route::get('/channels/{channel}/submissions/reported', 'ReportSubmissionsController@index')->middleware('moderator'); // checked

    // announcement
    Route::post('/announcements', 'AnnouncementController@store'); // checked 
    Route::post('/announcements/{announcement}/seen', 'AnnouncementController@seen'); // checked 
    Route::delete('/announcements/{announcement}', 'AnnouncementController@destroy'); // checked 
    Route::get('/announcements', 'AnnouncementController@get'); // checked 

    ////////////////////////////////////////////////////////////////////////
    // Below routes have a twin route prefixed with "guest"
    ////////////////////////////////////////////////////////////////////////
    Route::get('/users', 'UserController@get');
    Route::get('/feed', 'HomeController@feed');
    Route::get('/channels/submissions', 'ChannelController@submissions');

    Route::get('/submissions', 'SubmissionController@getBySlug');
    Route::get('/submissions/{submission}/comments', 'CommentController@index');
    Route::get('/channels/{channel}/moderators', 'ModeratorController@index'); // checked 
    Route::get('/channels/rules', 'RulesController@index');
    Route::get('/emojis', 'EmojiController@index');
    Route::get('/submissions/photos', 'SubmissionController@getPhotos');
    Route::get('/search', 'SearchController@index');
    Route::get('/channels', 'ChannelController@get');
    Route::get('/users/submissions', 'UserController@submissions');
    Route::get('/users/comments', 'UserController@comments');
    Route::get('/submissions/comments', 'CommentController@index');
    Route::get('/submissions/{submission}', 'SubmissionController@getById'); // checked 
});

////////////////////////////////////////////////////////////////////////
// Below routes are the twin routes for guests
////////////////////////////////////////////////////////////////////////
Route::prefix('guest')->group(function () {
    Route::get('/users', 'UserController@get');
    Route::get('/feed', 'HomeController@feed');
    Route::get('/channels/submissions', 'ChannelController@submissions');
    Route::get('/submissions', 'SubmissionController@getBySlug');
    Route::get('/submissions/{submission}/comments', 'CommentController@index');
    Route::get('/channels/{channel}/moderators', 'ModeratorController@index'); // checked 
    Route::get('/channels/rules', 'RulesController@index');
    Route::get('/emojis', 'EmojiController@index');
    Route::get('/submissions/photos', 'SubmissionController@getPhotos');
    Route::get('/search', 'SearchController@index');
    Route::get('/channels', 'ChannelController@get');
    Route::get('/users/submissions', 'UserController@submissions');
    Route::get('/users/comments', 'UserController@comments');
    Route::get('/submissions/comments', 'CommentController@index');
    Route::get('/submissions/{submission}', 'SubmissionController@getById'); // checked 
});

Route::post('/token/login', 'Auth\LoginController@getAccessToken');
Route::post('/token/register', 'Auth\RegisterController@getAccessToken');