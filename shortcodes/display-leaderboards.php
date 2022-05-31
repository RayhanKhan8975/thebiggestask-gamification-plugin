<?php
/**
 * Displays the LeaderBoards.
 *
 * @return void
 */
function display_leaderboards() {
	$leaderboards = get_option( 'tba_leaderboards' );
	$content      = '';

	$current_user_id = get_current_user_id();

	if ( ! empty( $leaderboards ) ) {
		$content = '<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
  <!--  <th scope="col">Avatar</th>-->
    <th scope="col">Name</th>
    <th scope="col">Points</th>
  </tr>
</thead>
<tbody>
  ';
		$count   = 0;
		foreach ( $leaderboards as $leaderboard ) {

			$content .= '
    <tr> 
    <td>' . $leaderboard['rank'] . '</td>
    <!--    <td class="img-td-leg"">
 <img class="img-fluid img-thumbnail leg-image" style="max-height:200px;" src="' . $leaderboard['avatar'] . '" alt="headshot for legislator">
    </td> -->
    <td>' . $leaderboard['Name'] . '</td>
    <td>' . $leaderboard['points'] . '</td>
  </tr>';
			$count++;

			if ( $count === 10 ) {
				break;
			}
		}

		$content .= '
    <tr> 
    <td>' . $leaderboards[ $current_user_id ]['rank'] . '</td>
<!--    <td class="img-td-leg"">
    <img class="img-fluid img-thumbnail leg-image" style="max-height:200px;" src="' . $leaderboards[ $current_user_id ]['avatar'] . '" alt="headshot for legislator">
    </td> --> 
    <td>' . $leaderboards[ $current_user_id ]['Name'] . '</td>
    <td>' . $leaderboards[ $current_user_id ]['points'] . '</td>
  </tr>';
		$content .= '
</tbody>
</table>';

	}

	return $content;
}
