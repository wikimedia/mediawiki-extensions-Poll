<?php

/**
 * @ingroup Extensions
 * @author Jan Luca <jan@toolserver.org>
 * @license http://creativecommons.org/licenses/by-sa/3.0/ Attribution-Share Alike 3.0 Unported or later
 */

class PollHooks {

	public static function onPollSchemaUpdates( $updater = null ) {
		$base = __DIR__;
		if ( $updater === null ) {
			global $wgDBtype, $wgExtNewFields, $wgExtPGNewFields, $wgExtNewIndexes, $wgExtNewTables;
			if ( $wgDBtype == 'mysql' ) {
				// "poll"-Table: All infomation about the polls
				$wgExtNewTables[] = array( 'poll', "$base/archives/Poll.sql" ); // Initial install tables
				$wgExtNewFields[] = array( 'poll', 'creater', "$base/archives/patch-creater.sql" ); // Add creater
				$wgExtNewFields[] = array( 'poll', 'dis', "$base/archives/patch-dis.sql" ); // Add dis
				$wgExtNewFields[] = array( 'poll', 'multi', "$base/archives/patch-multi.sql" ); // Add multi
				$wgExtNewFields[] = array( 'poll', 'ip', "$base/archives/patch-ip.sql" ); // Add ip
				$wgExtNewFields[] = array( 'poll', 'runtime', "$base/archives/patch-runtime.sql" ); // Add runtime
				$wgExtNewFields[] = array( 'poll', 'starttime', "$base/archives/patch-starttime.sql" ); // Add starttime
				$wgExtNewFields[] = array( 'poll', 'end', "$base/archives/patch-end.sql" ); // Add end

				// "poll_answer"-Table: The answer of the users
				$wgExtNewTables[] = array( 'poll_answer', "$base/archives/Poll-answer.sql" ); // Initial answer tables
				$wgExtNewFields[] = array( 'poll_answer', 'user', "$base/archives/patch-user.sql" ); // Add user
				$wgExtNewFields[] = array( 'poll_answer', 'vote_other', "$base/archives/patch-vote_other.sql" ); // Add vote_other
				$wgExtNewFields[] = array( 'poll_answer', 'ip', "$base/archives/patch-answer-ip.sql" ); // Add ip

				// "poll_start_log"-Table: Time with last run of Poll::start()
				$wgExtNewTables[] = array( 'poll_start_log', "$base/archives/Poll-start-log.sql" ); // Initial start_log tables
			}
		} else {
			if ( $updater->getDB()->getType() == 'mysql' ) {
				// "poll"-Table: All infomation about the polls
				$updater->addExtensionUpdate( array( 'addTable', 'poll', "$base/archives/Poll.sql", true ) ); // Initial install tables
				$updater->addExtensionUpdate( array( 'addField', 'poll', 'creater', "$base/archives/patch-creater.sql", true ) ); // Add creater
				$updater->addExtensionUpdate( array( 'addField', 'poll', 'dis', "$base/archives/patch-dis.sql", true ) ); // Add dis
				$updater->addExtensionUpdate( array( 'addField', 'poll', 'multi', "$base/archives/patch-multi.sql", true ) ); // Add multi
				$updater->addExtensionUpdate( array( 'addField', 'poll', 'ip', "$base/archives/patch-ip.sql", true ) ); // Add ip
				$updater->addExtensionUpdate( array( 'addField', 'poll', 'runtime', "$base/archives/patch-runtime.sql", true ) ); // Add runtime
				$updater->addExtensionUpdate( array( 'addField', 'poll', 'starttime', "$base/archives/patch-starttime.sql", true ) ); // Add starttime
				$updater->addExtensionUpdate( array( 'addField', 'poll', 'end', "$base/archives/patch-end.sql", true ) ); // Add end

				// "poll_answer"-Table: The answer of the users
				$updater->addExtensionUpdate( array( 'addTable', 'poll_answer', "$base/archives/Poll-answer.sql", true ) ); // Initial answer tables
				$updater->addExtensionUpdate( array( 'addField', 'poll_answer', 'user', "$base/archives/patch-user.sql", true ) ); // Add user
				$updater->addExtensionUpdate( array( 'addField', 'poll_answer', 'vote_other', "$base/archives/patch-vote_other.sql", true ) ); // Add vote_other
				$updater->addExtensionUpdate( array( 'addField', 'poll_answer', 'ip', "$base/archives/patch-answer-ip.sql", true ) ); // Add ip

				// "poll_start_log"-Table: Time with last run of Poll::start()
				$updater->addExtensionUpdate( array( 'addTable', 'poll_start_log', "$base/archives/Poll-start-log.sql", true ) ); // Initial start_log tables
			}
		}
		return true;
	}
}
