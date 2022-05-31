=== Gamification Plugin for The Biggest Ask ===
Requires at least: 5.2
Requires PHP: 7.2
License: GPL V2

The Plugin creates a Gamification system so users can stay on the site.
== Description ==
The Plugin fulfills these requirements of the gamification system:-

2. To get people to stay, users can earn points:

a. 5 points for starting a conversation that is relevant to surrogacy (limited to one question a day - users can ask more questions but they just get 5 points for one)
b. Awarding 5 points for answering a question AND getting a "like". Every additional "like" the person gets earns them 1 additional point.
c. Every week, all users are awarded 5 likes to distribute as they choose. The likes don't roll over - so it's just 5 likes a week that they can distribute.

3. Once a user earns 100 points, they get a $100 amazon gift card.

4. Every 100 points gets the users a $100 amazon gift card (for now) until we get lots of action and then we are going to have to decrease that :)

5. Getting a certain number of points will get you the rank of "experienced surrogate" or "experienced intended parent".




Badges:

Admin awarded badges include: 

•	Team Leader: “Achievement”
•	Empowering Others: when we notice someone being very helpful and supportive. Achievement

Automatic badges:

•	Experienced surrogate: a profile member who is a surrogate and has answered 25 questions :- Rank
•	Experienced intended parent: a profile member who is an intended parent and has answered 25 questions :- Rank
•	Conversation starter: a profile member who has asked 5 questions :- Achievement
•	Valued contributor: a profile member who received a “like” 5 times on their comment:- Achievement



Other details:

Have a leaderboard so people know where others rank

"Starting a conversation" must be surrogacy related and not promote and service or product or agency

== Algorithm ==

2a:- Starting a question means Creating a topic for discussion:- A topic is just a WordPress Custom Post Type in BuddyPress. So when a user creates a topic, we will check use the WordPress save_post_topic hook which is fired when
A topic is created for discussion. We will check in the user_meta when the last question was asked with the point rewarded to check if 24 hours have passed. If it did, then we will award the user 5 points that is saved in user_meta table of that user. 

2b:- Answer to a question is just a reply custom post type for BuddyPress. So when a user writes a reply we will use the save_post_reply to save empty meta fields like- Total Likes, an array of people who have liked it, etc.
We will add the like button to comments using this hook:-  bbp_theme_after_reply_content. The like button will have info like- user_id, comment_id,total likes, etc. When clicked it will make a request to the backend 
and in the post_meta of the comment, it will add the user_id which has liked it. We get the user_id of the user by using get_current_user_id() function. We also add 5 points to the commenter’s user_meta if it’s first like to that comment or else one like if it is not.
If the user decided to unlike(not to confuse with dislike) a comment which was previously liked by him, then again an ajax request will be made to the backend with the same infor like user_id, comment_id, etc it will first reduce the points the user has by 1 if the total number of likes hasn’t reached zero 
or else by 5 if the last like was also removed. Then we also remove the user’s user_id from the post_meta of the that comment. 

2c:- Starting on Monday each user will be awarded 5 likes when they will like a comment or a post, an ajax request will be made to reduce the number of likes they have and can spend. If it’s for comment then the same ajax request will be used as above if it’s a post then we will have to use a different request. The number of likes the user has will keep decreasing by 1 if they spend it or increase by 1 if they decide to, unlike a post/comment.    If the number of likes available for that user reaches zero, the like button will simply be disabled and any attempt to like a post will be futile. The user’s can still 
retrieve likes by unliking other posts. The likes will be reset on the next Monday.

3. Every Monday we will run a WordPress Cron Job to check which users have 100 points stored in user_meta and he/she hasn’t been awarded earlier. A mail will be sent to MJ(probably) or someone else with the list of people who are eligible for the 100$ Amazon Gift Card. Please let me know if you need a HTML email or a text one 😊.

4. When the plugin is first initialized we will create the achievements on the architecture of the GamiPress Plugin by adding some custom posts to the wp_posts table. Achievements for Achievements Post Type and Ranks for Rank Post Type, the Gamipress system follows a specific pattern for creating achievement types. We will use the same pattern for making Gamipress believe that it’s created by itself. The following tables are the ones we make changes too:- wp_posts, wp_postmeta, wp_usermeta, wp_gamipress_logs, wp_gamipress_logs_meta, wp_gamipress_user_earnings, etc
We will simply use conditional checks every week or twice a week to check which user meets the criteria to be awarded the achievement. There will be achievements that will be admin awarded only, they can only be awarded through the thebiggestask.com/wp-admin/user-edit.php?user_id=user_id dashboard and can also be revoked. 

To award users just use the following functions:- gamipress_award_rank_to_user( $rank_id = 0, $user_id = 0)

gamipress_award_achievement_to_user( $achievement->ID, $user_id )

5. Leaderboards:- We will run a loop on each user to grab the number of points they have and add it to an array which will be stored at wp_options table. We will use that option to retrieve leaderboard values and display them through a shortcode. 

