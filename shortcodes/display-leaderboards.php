<?php
/**
 * Displays the LeaderBoards.
 *
 * @return void
 */
function display_leaderboards() {
	$leaderboards = get_option( 'tba_leaderboards' );

	if ( ! empty( $leaderboards ) ) {
		$content = '<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Points</th>
  </tr>
</thead>
<tbody>
  ';

		foreach ( $leaderboards as $leaderboard ) {

			$content .= '
    <tr> 
    <td>' . $leaderboard['rank'] . '</td>
    <td class="img-td-leg"">
    <img class="img-fluid img-thumbnail leg-image" style="max-height:200px;" src="' . $leaderboard['avatar'] . '" alt="headshot for legislator">
    </td> 
    <td>' . $leaderboard['Name'] . '</td>
    <td>' . $leaderboard['points'] . '</td>
  </tr>';
		}

		$content .= '
</tbody>
</table>';

	}

	return $content;
}
