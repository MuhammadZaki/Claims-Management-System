/**
 * New script file
 */

/**
* Approval function for claims
* @param {hia.ApproveClaim} tx - Approve Claim transaction object
* @transaction
*/
async function AprroveClaim(tx) {
  let claim = tx.claim;
  if (claim.state == "Pending") {
  	claim.state = "Approved";
  } else
  {
  	throw new Error('can not approve a claim that is not in pending state');
  }
  let claimRegistry = await getAssestRegistry('hia.Claim');
  await claimRegistry.update(claim);
}

/**
* Rejection function for claims
* @param {hia.RejectClaim} tx - Reject Claim transaction object
* @transaction
*/
async function RejectClaim(tx) {
   let claim = tx.claim;
  if (claim.state == "Pending") {
  	claim.state = "Rejected";
  } else
  {
  	throw new Error('can not reject a claim that is not in pending state');
  }
  let claimRegistry = await getAssestRegistry('hia.Claim');
  await claimRegistry.update(claim);
}