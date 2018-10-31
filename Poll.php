<?php
/**
 * Poll - Create a specialpage for useing polls in MediaWiki
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * require_once("$IP/extensions/Poll/Poll.php");
 *
 * @file
 * @ingroup Extensions
 * @author Jan Luca <jan@toolserver.org>
 * @version 1.0 (Beta)
 * @link https://www.mediawiki.org/wiki/Extension:Poll2 Documentation
 * @license http://creativecommons.org/licenses/by-sa/3.0/ Attribution-Share Alike 3.0 Unported or later
 */

/**
 * Protect against register_globals vulnerabilities.
 * This line must be present before any global variable is referenced.
 */

// Die the extension, if not MediaWiki is used
if ( !defined( 'MEDIAWIKI' ) ) {
	echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
	die( -1 );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['specialpage'][] = array(
	'name'           => 'Poll',
	'version'        => '1.1',
	'path'           => __FILE__,
	'author'         => 'Jan Luca',
	'url'            => 'https://www.mediawiki.org/wiki/Extension:Poll',
	'descriptionmsg' => 'poll-desc'
);

// New right: poll-admin
$wgGroupPermissions['sysop']['poll-admin'] = true;
$wgGroupPermissions['*']['poll-admin'] = false;
$wgAvailableRights[] = 'poll-admin';

// New right: poll-create
$wgGroupPermissions['autoconfirmed']['poll-create'] = true;
$wgGroupPermissions['*']['poll-create'] = false;
$wgAvailableRights[] = 'poll-create';

// New right: poll-create
$wgGroupPermissions['autoconfirmed']['poll-vote'] = true;
$wgGroupPermissions['*']['poll-vote'] = false;
$wgAvailableRights[] = 'poll-vote';

// New right: poll-score
$wgGroupPermissions['*']['poll-score'] = true;
$wgAvailableRights[] = 'poll-score';

// Infomation about the Special Page "Poll"
$wgAutoloadClasses['Poll'] = __DIR__ . '/Poll_body.php'; # Tell MediaWiki to load the extension body.
$wgAutoloadClasses['PollHooks'] = __DIR__ . '/PollHooks.php';
$wgMessagesDirs['Poll'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['PollAlias'] = __DIR__ . '/Poll.alias.php';
$wgSpecialPages['Poll'] = 'Poll'; # Let MediaWiki know about your new special page.

// Log
$wgLogTypes[] = 'poll';
$wgLogNames['poll'] = 'poll-logpage';
$wgLogHeaders['poll'] = 'poll-logpagetext';
$wgLogActions['poll/create'] = 'poll-logentry-create';
$wgLogActions['poll/change'] = 'poll-logentry-change';
$wgLogActions['poll/delete'] = 'poll-logentry-delete';

// Schema changes
$wgHooks['LoadExtensionSchemaUpdates'][] = 'PollHooks::onPollSchemaUpdates';
