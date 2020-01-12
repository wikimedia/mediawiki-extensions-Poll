<?php

/**
 * @ingroup Extensions
 * @author Jan Luca <jan@toolserver.org>
 * @license http://creativecommons.org/licenses/by-sa/3.0/ Attribution-Share Alike 3.0 Unported or later
 */

class PollHooks {

	public static function onPollSchemaUpdates( DatabaseUpdater $updater ) {
		$base = __DIR__;
		if ( $updater->getDB()->getType() == 'mysql' ) {
			// "poll"-Table: All infomation about the polls
			$updater->addExtensionUpdate( array( 'addTable', 'poll', "$base/../sql/Poll.sql", true ) ); // Initial install tables
			$updater->addExtensionUpdate( array( 'addField', 'poll', 'creater', "$base/../sql/patch-creater.sql", true ) ); // Add creater
			$updater->addExtensionUpdate( array( 'addField', 'poll', 'dis', "$base/../sql/patch-dis.sql", true ) ); // Add dis
			$updater->addExtensionUpdate( array( 'addField', 'poll', 'multi', "$base/../sql/patch-multi.sql", true ) ); // Add multi
			$updater->addExtensionUpdate( array( 'addField', 'poll', 'ip', "$base/../sql/patch-ip.sql", true ) ); // Add ip
			$updater->addExtensionUpdate( array( 'addField', 'poll', 'runtime', "$base/../sql/patch-runtime.sql", true ) ); // Add runtime
			$updater->addExtensionUpdate( array( 'addField', 'poll', 'starttime', "$base/../sql/patch-starttime.sql", true ) ); // Add starttime
			$updater->addExtensionUpdate( array( 'addField', 'poll', 'end', "$base/../sql/patch-end.sql", true ) ); // Add end

			// "poll_answer"-Table: The answer of the users
			$updater->addExtensionUpdate( array( 'addTable', 'poll_answer', "$base/../sql/Poll-answer.sql", true ) ); // Initial answer tables
			$updater->addExtensionUpdate( array( 'addField', 'poll_answer', 'user', "$base/../sql/patch-user.sql", true ) ); // Add user
			$updater->addExtensionUpdate( array( 'addField', 'poll_answer', 'vote_other', "$base/../sql/patch-vote_other.sql", true ) ); // Add vote_other
			$updater->addExtensionUpdate( array( 'addField', 'poll_answer', 'ip', "$base/../sql/patch-answer-ip.sql", true ) ); // Add ip

			// "poll_start_log"-Table: Time with last run of Poll::start()
			$updater->addExtensionUpdate( array( 'addTable', 'poll_start_log', "$base/../sql/Poll-start-log.sql", true ) ); // Initial start_log tables
		}
	}
}
